<?php
session_start();

include "include.php";

$breadcrumb = "";
navbar($breadcrumb);

require_once 'conecta.php';

$sql = "SELECT 
          usuario.nome, 
          COALESCE(mineral_contagem.quantidade_mineral, 0) AS quantidade_mineral, 
          COALESCE(rocha_contagem.quantidade_rocha, 0) AS quantidade_rocha
        FROM 
          usuario
        LEFT JOIN 
          (SELECT idusuario, COUNT(*) AS quantidade_mineral 
           FROM mineral 
           GROUP BY idusuario) AS mineral_contagem 
        ON 
          usuario.idusuario = mineral_contagem.idusuario
        LEFT JOIN 
          (SELECT idusuario, COUNT(*) AS quantidade_rocha 
           FROM rocha 
           GROUP BY idusuario) AS rocha_contagem 
        ON 
          usuario.idusuario = rocha_contagem.idusuario
";

$conexao = conectar();
$resultado = mysqli_query($conexao, $sql);

$grafico = [];
$quantidades = [];

while ($dados = mysqli_fetch_array($resultado)) {
  $nome = $dados['nome'];
  $quantidade_mineral = $dados['quantidade_mineral'] !== null ? $dados['quantidade_mineral'] : 0;
  $quantidade_rocha = $dados['quantidade_rocha'] !== null ? $dados['quantidade_rocha'] : 0;
  $total_quantidade = $quantidade_mineral + $quantidade_rocha;
  $grafico[] = "['" . $nome . "', " . $quantidade_mineral . "," . $quantidade_rocha . "]";
  $quantidades[$nome] = $total_quantidade;
}

// Ordena o array $grafico com base nas quantidades totais
arsort($quantidades);
$graficoOrdenado = [];
foreach ($quantidades as $nome => $total) {
  foreach ($grafico as $dados) {
    if (strpos($dados, $nome) !== false) {
      $graficoOrdenado[] = $dados;
      break;
    }
  }
}

$grafico = implode(", ", $graficoOrdenado);
?>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<body>
  <main>
    <div class="container">
      <div class="vertical-line"></div>
      <div class="section-content">
        <div class="section">
          <h4 class="left-align">Colaboradores</h4>
          <h6 class="left-align">Tabela com colaboradores do IF GeoLab.</h6>
          <hr class="divider">
        </div>
        <script type="text/javascript">
          google.charts.load('current', {
            'packages': ['bar']
          });
          google.charts.setOnLoadCallback(drawChart);

          // Redesenha o gráfico quando a janela é redimensionada
          window.addEventListener('resize', drawChart);

          function drawChart() {
            var dataArray = [
              ['Nome', 'Minerais', 'Rochas'],
              <?php echo $grafico; ?>
            ];

            var data = google.visualization.arrayToDataTable(dataArray);

            var options = {
              chart: {
                title: 'Colaboradores',
                subtitle: 'Amostras Cadastradas',
                titleTextStyle: {
                  fontName: 'Merriweather',
                  fontSize: 18
                },
                subtitleTextStyle: {
                  fontName: 'Merriweather',
                  fontSize: 14
                }
              },
              colors: ['#6eaa5e', '#3b5534', '#03300b'],
              bars: 'vertical',
              hAxis: {
                textStyle: {
                  color: '#808080',
                  fontName: 'Merriweather',
                  fontSize: 12
                },
                titleTextStyle: {
                  color: '#588157',
                  fontName: 'Merriweather',
                  fontSize: 14
                },
                gridlines: {
                  color: '#707070'
                }
              },
              vAxis: {
                textStyle: {
                  color: '#707070',
                  fontName: 'Merriweather',
                  fontSize: 12
                },
                titleTextStyle: {
                  color: '#808080',
                  fontName: 'Merriweather',
                  fontSize: 14
                },
                gridlines: {
                  color: '#909090'
                }
              },
              height: 400,
              backgroundColor: 'transparent',
              chartArea: {
                backgroundColor: 'transparent',
                width: '90%', // Ajusta a largura da área do gráfico
                height: '70%' // Ajusta a altura da área do gráfico
              },
              bar: {
                groupWidth: '70%'
              },
              legend: {
                position: 'top',
                textStyle: {
                  fontName: 'Merriweather',
                  fontSize: 12
                }
              }
            };

            var chart = new google.charts.Bar(document.getElementById('barchart_material'));
            chart.draw(data, google.charts.Bar.convertOptions(options));
          }
        </script>

        <style>
          #barchart_material {
            margin: 0;
            text-align: center;
            padding: 15px 10px 0;
            width: 100%;
            /* Ocupa toda a largura do contêiner */
            max-width: 1000px;
            /* Limite máximo de largura */
          }
        </style>

        <div id="barchart_material"></div>
      </div>
  </main>
  <?php include_once "footer.php"; ?>