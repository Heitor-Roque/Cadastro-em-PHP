<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado</title>
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --bg: #0d0d0d;
            --surface: #161616;
            --surface-2: #1e1e1e;
            --border: rgba(255,255,255,0.07);
            --accent: #c8f03c;
            --text: #f0ede6;
            --text-muted: #6a6a6a;
            --radius: 10px;
        }

        html, body {
            min-height: 100vh;
            background-color: var(--bg);
            background-image:
                radial-gradient(ellipse 60% 40% at 70% 10%, rgba(200,240,60,0.05) 0%, transparent 60%);
            font-family: 'DM Sans', sans-serif;
            color: var(--text);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
        }

        .card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 18px;
            padding: 48px 44px;
            width: 100%;
            max-width: 420px;
            text-align: center;
        }

        .icon-wrap {
            width: 56px;
            height: 56px;
            border-radius: 14px;
            margin: 0 auto 28px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .icon-wrap.success {
            background: rgba(200,240,60,0.12);
        }

        .icon-wrap.error {
            background: rgba(220,70,70,0.12);
        }

        .icon-wrap svg {
            width: 24px;
            height: 24px;
            fill: none;
            stroke-width: 2;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .icon-wrap.success svg { stroke: var(--accent); }
        .icon-wrap.error svg { stroke: #dc4646; }

        h2 {
            font-family: 'DM Serif Display', serif;
            font-weight: 400;
            font-size: 1.6rem;
            color: var(--text);
            margin-bottom: 10px;
        }

        .sub {
            font-size: 0.84rem;
            color: var(--text-muted);
            line-height: 1.6;
            margin-bottom: 32px;
        }

        .error-detail {
            background: var(--surface-2);
            border: 1px solid rgba(220,70,70,0.2);
            border-radius: var(--radius);
            padding: 14px 16px;
            font-size: 0.8rem;
            color: #e07070;
            text-align: left;
            line-height: 1.7;
            margin-bottom: 28px;
        }

        a.btn-back {
            display: inline-block;
            background: var(--accent);
            border-radius: var(--radius);
            padding: 11px 28px;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.88rem;
            font-weight: 500;
            color: #0d0d0d;
            text-decoration: none;
            transition: opacity 0.15s;
        }

        a.btn-back:hover { opacity: 0.88; }
    </style>
</head>
<body>
    <div class="card">
        <?php
            $hostname = "127.0.0.1";
            $user     = "root";
            $password = "";
            $database = "cadastro carro cliente";

            $conexao = new mysqli($hostname, $user, $password, $database);

            if ($conexao->connect_errno) {
                echo '<div class="icon-wrap error"><svg viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></div>';
                echo '<h2>Falha na conexão</h2>';
                echo '<p class="sub">Não foi possível conectar ao banco de dados.</p>';
                echo '<div class="error-detail">' . htmlspecialchars($conexao->connect_error) . '</div>';
            } else {
                $nome_clientela            = $conexao->real_escape_string($_POST['nome_clientela']);
                $endereço_clientela        = $conexao->real_escape_string($_POST['endereço_clientela']);
                $numero_endereço_clientela = $conexao->real_escape_string($_POST['numero_endereço_clientela']);
                $bairro_clientela          = $conexao->real_escape_string($_POST['bairro_clientela']);
                $estado                    = $conexao->real_escape_string($_POST['estado']);
                $marca                     = $conexao->real_escape_string($_POST['marca']);
                $modelo                    = $conexao->real_escape_string($_POST['modelo']);
                $ano_fabricação            = $conexao->real_escape_string($_POST['ano_fabricação']);
                $nome_fornecedor           = $conexao->real_escape_string($_POST['nome_fornecedor']);
                $data_entrega              = $conexao->real_escape_string($_POST['data_entrega']);

                $sqls = [
                    "clientela"  => "INSERT INTO clientela (nome_clientela, endereço_clientela, numero_endereço_clientela, bairro_clientela, estado)
                                     VALUES ('$nome_clientela', '$endereço_clientela', '$numero_endereço_clientela', '$bairro_clientela', '$estado')",
                    "carro"      => "INSERT INTO carro (marca, modelo, ano_fabricação)
                                     VALUES ('$marca', '$modelo', '$ano_fabricação')",
                    "fornecedor" => "INSERT INTO fornecedor (nome_fornecedor, data_entrega)
                                     VALUES ('$nome_fornecedor', '$data_entrega')"
                ];

                $erros = [];
                foreach ($sqls as $tabela => $sql) {
                    if (!$conexao->query($sql)) {
                        $erros[] = ucfirst($tabela) . ": " . $conexao->error;
                    }
                }

                $conexao->close();

                if (empty($erros)) {
                    echo '<div class="icon-wrap success"><svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg></div>';
                    echo '<h2>Cadastro realizado</h2>';
                    echo '<p class="sub">Os dados foram registrados com sucesso no sistema.</p>';
                } else {
                    echo '<div class="icon-wrap error"><svg viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></div>';
                    echo '<h2>Erro no cadastro</h2>';
                    echo '<p class="sub">Não foi possível salvar todos os dados. Veja os detalhes abaixo.</p>';
                    echo '<div class="error-detail">' . implode('<br>', array_map('htmlspecialchars', $erros)) . '</div>';
                }
            }
        ?>
        <a href="index.php" class="btn-back">← Voltar ao cadastro</a>
    </div>
</body>
</html>
