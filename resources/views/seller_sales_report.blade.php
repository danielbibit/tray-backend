Olá {{ $reportData['seller_name'] }},
Seu total de vendas na data {{ date('Y-m-d') }} foi de {{ $reportData['number_of_sales']}} vendas.
Somando um total de R${{ $reportData['total_sales'] }} e sua comissão foi de R${{ $reportData['total_comission'] }}.
