<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Deputado;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Jobs\ProcessarGastosDeputado;

class ImportarDeputadoJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle()
    {
        Log::channel('deputados')->info('🔄 Iniciando sincronização de deputados');

        $pagina = 1;
        $urlBase = 'https://dadosabertos.camara.leg.br/api/v2/deputados';
        $proximaUrl = "{$urlBase}?pagina={$pagina}&itens=100";

        do {
            $response = Http::withoutVerifying()->get($proximaUrl);

            if (!$response->successful()) {
                Log::channel('deputados')->error("❌ Erro ao buscar página $pagina: HTTP {$response->status()}");
                break;
            }

            $dados = $response->json();

            Log::channel('deputados')->info("📥 Página $pagina importada com " . count($dados['dados'] ?? []) . " deputados");

            foreach ($dados['dados'] ?? [] as $dep) {
                $deputado = Deputado::updateOrCreate(
                    ['id' => $dep['id']],
                    [
                        'nome' => $dep['nome'],
                        'partido' => $dep['siglaPartido'],
                        'uf' => $dep['siglaUf'],
                    ]
                );

                Log::channel('deputados')->info("✅ Deputado salvo: {$deputado->id} - {$deputado->nome}");
            }

            $proximaUrl = collect($dados['links'])->firstWhere('rel', 'next')['href'] ?? null;
            $pagina++;

        } while ($proximaUrl);

        // Disparar os jobs de gastos depois de importar todos
        Deputado::each(function ($deputado) {
            ProcessarGastosDeputado::dispatch($deputado)->onQueue('gastos');
            Log::channel('deputados')->info("📤 Disparado job de gastos para deputado ID {$deputado->id}");
        });

        Log::channel('deputados')->info('✅ Sincronização de deputados concluída e jobs de gastos enfileirados');
    }
}
