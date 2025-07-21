<?php

namespace App\Jobs;

use App\Models\Deputado;
use App\Models\GastoDeputado;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ProcessarGastosDeputado implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $deputado;

    public function __construct(Deputado $deputado)
    {
        $this->deputado = $deputado;
    }

    public function handle()
    {
        Log::channel('gastos')->info("🔄 Iniciando processamento de gastos para: {$this->deputado->id} - {$this->deputado->nome}");

        $pagina = 1;

        do {
            $url = "https://dadosabertos.camara.leg.br/api/v2/deputados/{$this->deputado->id}/despesas?pagina=$pagina&itens=100";
            $response = Http::withoutVerifying()->get($url);

            if (!$response->successful()) {
                Log::channel('gastos')->error("❌ Erro na página $pagina do deputado {$this->deputado->id}: HTTP {$response->status()}");
                break;
            }

            $dados = $response->json();
            $gastos = $dados['dados'] ?? [];

            Log::channel('gastos')->info("📄 Página $pagina: " . count($gastos) . " registros encontrados para deputado ID {$this->deputado->id}");

            foreach ($gastos as $gasto) {
                GastoDeputado::updateOrCreate(
                    [
                        'deputado_id' => $this->deputado->id,
                        'ano' => $gasto['ano'] ?? now()->year,  // <- prevenção contra null
                        'mes' => $gasto['mes'] ?? now()->month,
                        'tipo_despesa' => $gasto['tipoDespesa'],
                        'fornecedor' => $gasto['nomeFornecedor'],
                        'cnpj_cpf' => $gasto['cnpjCpfFornecedor'],
                        'valor' => $gasto['valorDocumento'],
                        'data' => $gasto['dataDocumento'] ?? now()
                    ]
                );

                Log::channel('gastos')->debug("💾 Gasto salvo: {$gasto['ano']}/{$gasto['mes']} - {$gasto['tipoDespesa']} ({$gasto['valorDocumento']})");
            }

            $proxima = collect($dados['links'])->firstWhere('rel', 'next')['href'] ?? null;
            $pagina++;
        } while ($proxima);

        Log::channel('gastos')->info("✅ Finalizado gastos do deputado: {$this->deputado->id} - {$this->deputado->nome}");
    }
}
