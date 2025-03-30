<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagamento PIX</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Poppins', sans-serif;
            height: 100vh;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #ffa726; /* Fundo laranja vibrante */
            color: #333;
            position: relative;
            overflow: hidden;
        }

        .pix-container {
            display: flex;
            align-items: center;
            background: #fff;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.1);
            max-width: 700px;
            width: 90%; /* Ajuste para ocupar 90% da largura da tela */
            animation: float 3s ease-in-out infinite;
            position: relative;
            z-index: 2;
            flex-direction: column; /* Alinha o conteúdo em coluna para telas menores */
        }

        .pix-text {
            margin-top: 1rem;
            text-align: center;
        }

        .pix-text h1 {
            font-size: 2.5rem;
            color: #e53935;
            margin-bottom: 0.5rem;
        }

        .pix-text p {
            font-size: 1.25rem;
            color: #666;
            margin-bottom: 1.5rem;
        }

        #container-code {
            max-width: 300px;
        }

        #codigoPix {
            font-weight: bold;
            background: #f5f5f5;
            color: #333;
            margin-right:300px;
            border-radius: 5px;
            display: inline-block;
            margin-top: 1rem;
            font-size:10px;
        }

        button {
            display: inline-block;
            padding: 0.75rem 1.5rem;
            background-color: #e53935;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            font-weight: 600;
            transition: background-color 0.3s;
            border: none;
            font-size: 1rem;
            cursor: pointer;
            margin-top: 1rem;
        }

        button:hover {
            background-color: #d32f2f;
        }

        img {
            display: block;
            margin: 0 auto;
            border-radius: 10px;
            margin-bottom: 1rem;
        }

        .background-text {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            color: rgba(255, 255, 255, 0.1);
            font-size: 5rem;
            font-weight: bold;
            z-index: 0;
            pointer-events: none;
        }

        /* Responsivo: ajustes para telas menores */
        @media (max-width: 600px) {
            .pix-container {
                max-width: 100%;
                padding: 1.5rem;
            }

            .pix-text h1 {
                font-size: 2rem;
            }

            .pix-text p {
                font-size: 1rem;
            }
        }

        /* Animação de flutuação */
        @keyframes float {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-10px);
            }
        }
    </style>
    <script>
        function copiarCodigo() {
            var codigoPix = document.getElementById('codigoPix');
            var inputTemp = document.createElement('textarea');
            inputTemp.value = codigoPix.textContent;
            document.body.appendChild(inputTemp);
            inputTemp.select();
            document.execCommand('copy');
            document.body.removeChild(inputTemp);
            alert('Código PIX copiado para a área de transferência!');
        }
    </script>
</head>
<body>
    <div class="pix-container">
        <?php
            function formataCampo($id, $valor) {
                return $id . str_pad(strlen($valor), 2, '0', STR_PAD_LEFT) . $valor;
            }

            function calculaCRC16($dados) {
                $resultado = 0xFFFF;
                for ($i = 0; $i < strlen($dados); $i++) {
                    $resultado ^= (ord($dados[$i]) << 8);
                    for ($j = 0; $j < 8; $j++) {
                        if ($resultado & 0x8000) {
                            $resultado = ($resultado << 1) ^ 0x1021;
                        } else {
                            $resultado <<= 1;
                        }
                        $resultado &= 0xFFFF;
                    }
                }
                return strtoupper(str_pad(dechex($resultado), 4, '0', STR_PAD_LEFT));
            }

            function geraPix($chave, $idTx = '', $valor = 0.00) {
                $resultado = "000201";
                $resultado .= formataCampo("26", "0014br.gov.bcb.pix" . formataCampo("01", $chave));
                $resultado .= "52040000";
                $resultado .= "5303986";
                if ($valor > 0) {
                    $resultado .= formataCampo("54", number_format($valor, 2, '.', ''));
                }
                $resultado .= "5802BR";
                $resultado .= "5901N";
                $resultado .= "6001C";
                $resultado .= formataCampo("62", formataCampo("05", $idTx ?: '***'));
                $resultado .= "6304";
                $resultado .= calculaCRC16($resultado);
                return $resultado;
            }

            $chave = "28690442839";
            $valorTransacao = $_GET['total'];
            $idTransacao = "CantinaExpress";
            $codigoPix = geraPix($chave, $idTransacao, $valorTransacao);

            echo '<img src="https://quickchart.io/qr?text=' . urlencode($codigoPix) . '&size=300" alt="QR Code">';
            echo '<div class="pix-text">';
            echo '<h1>Pagamento PIX</h1>';
            echo '<p>Utilize o código abaixo ou o QR Code para realizar o pagamento:</p>';
            echo '<div id=container-code>
            <p id="codigoPix">' . $codigoPix . '</p> </div>';
            echo '<button onclick="copiarCodigo()">Copiar Código PIX</button>';
            echo '</div>';
        ?>
    </div>
    <div class="background-text">PIX</div>
</body>
</html>
