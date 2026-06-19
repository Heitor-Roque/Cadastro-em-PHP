<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --bg: #0d0d0d;
            --surface: #161616;
            --surface-2: #1e1e1e;
            --border: rgba(255,255,255,0.07);
            --border-hover: rgba(255,255,255,0.15);
            --accent: #c8f03c;
            --accent-dim: rgba(200,240,60,0.1);
            --text: #f0ede6;
            --text-muted: #6a6a6a;
            --text-label: #999;
            --radius: 10px;
        }

        html, body {
            min-height: 100vh;
            background-color: var(--bg);
            background-image:
                radial-gradient(ellipse 60% 40% at 70% 10%, rgba(200,240,60,0.05) 0%, transparent 60%),
                radial-gradient(ellipse 40% 30% at 10% 80%, rgba(200,240,60,0.03) 0%, transparent 50%);
            font-family: 'DM Sans', sans-serif;
            color: var(--text);
            display: flex;
            align-items: flex-start;
            justify-content: center;
            padding: 60px 20px;
        }

        .layout {
            display: grid;
            grid-template-columns: 220px 1fr;
            gap: 48px;
            width: 100%;
            max-width: 860px;
            align-items: start;
        }

        .sidebar {
            position: sticky;
            top: 60px;
        }

        .logo-mark {
            width: 36px;
            height: 36px;
            background: var(--accent);
            border-radius: 8px;
            margin-bottom: 28px;
        }

        .sidebar h1 {
            font-family: 'DM Serif Display', serif;
            font-size: 2rem;
            font-weight: 400;
            line-height: 1.2;
            color: var(--text);
            margin-bottom: 14px;
        }

        .sidebar p {
            font-size: 0.82rem;
            color: var(--text-muted);
            line-height: 1.6;
        }

        .nav-steps {
            margin-top: 36px;
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .nav-step {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 8px 10px;
            border-radius: var(--radius);
            font-size: 0.8rem;
            color: var(--text-muted);
        }

        .nav-step.active {
            background: var(--accent-dim);
            color: var(--accent);
        }

        .nav-step .dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: currentColor;
            flex-shrink: 0;
        }

        .form-panel {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 18px;
            padding: 36px 40px 40px;
        }

        .section { margin-bottom: 0; }

        .section-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 20px;
        }

        .section-icon {
            width: 30px;
            height: 30px;
            border-radius: 8px;
            background: var(--surface-2);
            border: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .section-icon svg { width: 14px; height: 14px; stroke: var(--text-muted); fill: none; stroke-width: 1.5; }

        .section-title {
            font-size: 0.7rem;
            font-weight: 500;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: var(--text-muted);
        }

        .divider {
            height: 1px;
            background: var(--border);
            margin: 28px 0;
        }

        .grid-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px;
        }

        .grid-3 {
            display: grid;
            grid-template-columns: 1fr 1fr 80px;
            gap: 14px;
        }

        .field {
            display: flex;
            flex-direction: column;
            gap: 7px;
        }

        .field.span-2 { grid-column: span 2; }

        label {
            font-size: 0.73rem;
            font-weight: 500;
            color: var(--text-label);
            letter-spacing: 0.02em;
        }

        input[type="text"],
        input[type="date"] {
            background: var(--surface-2);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 10px 14px;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.88rem;
            color: var(--text);
            outline: none;
            transition: border-color 0.2s, background 0.2s;
            width: 100%;
            -webkit-appearance: none;
        }

        input::placeholder { color: var(--text-muted); }
        input:hover { border-color: var(--border-hover); }
        input:focus {
            border-color: var(--accent);
            background: rgba(200,240,60,0.03);
        }

        input[type="date"]::-webkit-calendar-picker-indicator {
            filter: invert(0.4);
            cursor: pointer;
        }

        .btn-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 32px;
            padding-top: 24px;
            border-top: 1px solid var(--border);
        }

        .btn-hint {
            font-size: 0.75rem;
            color: var(--text-muted);
        }

        button[type="submit"] {
            background: var(--accent);
            border: none;
            border-radius: var(--radius);
            padding: 11px 28px;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.88rem;
            font-weight: 500;
            color: #0d0d0d;
            cursor: pointer;
            transition: opacity 0.15s, transform 0.1s;
        }

        button[type="submit"]:hover { opacity: 0.88; }
        button[type="submit"]:active { transform: scale(0.98); }

        @media (max-width: 680px) {
            .layout { grid-template-columns: 1fr; }
            .sidebar { position: static; }
            .nav-steps { display: none; }
            .grid-2, .grid-3 { grid-template-columns: 1fr; }
            .field.span-2 { grid-column: span 1; }
            .form-panel { padding: 24px 20px 28px; }
            .btn-row { flex-direction: column; gap: 14px; align-items: stretch; }
            button[type="submit"] { text-align: center; }
        }
    </style>
</head>
<body>
    <div class="layout">
        <aside class="sidebar">
            <div class="logo-mark"></div>
            <h1>Novo cadastro</h1>
            <p>Preencha os dados do cliente, veículo e fornecedor para registrar no sistema.</p>
            <nav class="nav-steps">
                <div class="nav-step active"><span class="dot"></span> Dados pessoais</div>
                <div class="nav-step active"><span class="dot"></span> Veículo</div>
                <div class="nav-step active"><span class="dot"></span> Fornecedor</div>
            </nav>
        </aside>

        <div class="form-panel">
            <form method="post" action="cadastro_clientela.php">

                <div class="section">
                    <div class="section-header">
                        <div class="section-icon">
                            <svg viewBox="0 0 24 24"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>
                        </div>
                        <span class="section-title">Dados pessoais</span>
                    </div>

                    <div class="grid-2" style="margin-bottom: 14px;">
                        <div class="field span-2">
                            <label for="nome_clientela">Nome completo</label>
                            <input type="text" name="nome_clientela" id="nome_clientela" placeholder="Ex: João Silva">
                        </div>
                    </div>
                    <div class="grid-3">
                        <div class="field span-2">
                            <label for="endereço_clientela">Endereço</label>
                            <input type="text" name="endereço_clientela" id="endereço_clientela" placeholder="Rua, Avenida...">
                        </div>
                        <div class="field">
                            <label for="numero_endereço_clientela">Nº</label>
                            <input type="text" name="numero_endereço_clientela" id="numero_endereço_clientela" placeholder="123">
                        </div>
                    </div>
                    <div class="grid-2" style="margin-top: 14px;">
                        <div class="field">
                            <label for="bairro_clientela">Bairro</label>
                            <input type="text" name="bairro_clientela" id="bairro_clientela" placeholder="Ex: Centro">
                        </div>
                        <div class="field">
                            <label for="estado">Estado</label>
                            <input type="text" name="estado" id="estado" placeholder="Ex: SP">
                        </div>
                    </div>
                </div>

                <div class="divider"></div>

                <div class="section">
                    <div class="section-header">
                        <div class="section-icon">
                            <svg viewBox="0 0 24 24"><rect x="2" y="8" width="20" height="10" rx="2"/><path d="M6 8V6a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v2"/><circle cx="7" cy="17" r="1.5"/><circle cx="17" cy="17" r="1.5"/></svg>
                        </div>
                        <span class="section-title">Veículo</span>
                    </div>

                    <div class="grid-3">
                        <div class="field">
                            <label for="marca">Marca</label>
                            <input type="text" name="marca" id="marca" placeholder="Ex: Toyota">
                        </div>
                        <div class="field">
                            <label for="modelo">Modelo</label>
                            <input type="text" name="modelo" id="modelo" placeholder="Ex: Corolla">
                        </div>
                        <div class="field">
                            <label for="ano_fabricação">Ano</label>
                            <input type="text" name="ano_fabricação" id="ano_fabricação" placeholder="2024">
                        </div>
                    </div>
                </div>

                <div class="divider"></div>

                <div class="section">
                    <div class="section-header">
                        <div class="section-icon">
                            <svg viewBox="0 0 24 24"><path d="M20 7H4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/></svg>
                        </div>
                        <span class="section-title">Fornecedor</span>
                    </div>

                    <div class="grid-2">
                        <div class="field">
                            <label for="nome_fornecedor">Nome do fornecedor</label>
                            <input type="text" name="nome_fornecedor" id="nome_fornecedor" placeholder="Nome da empresa">
                        </div>
                        <div class="field">
                            <label for="data_entrega">Data de entrega</label>
                            <input type="date" name="data_entrega" id="data_entrega">
                        </div>
                    </div>
                </div>

                <div class="btn-row">
                    <span class="btn-hint">Todos os campos são obrigatórios</span>
                    <button type="submit">Cadastrar →</button>
                </div>

            </form>
        </div>
    </div>
</body>
</html>
