# Manual Técnico e Operacional - Projeto SAFE

## 1. Introdução
O **SAFE (Sistema de Autorização e Fluxo Escolar)** é um protótipo funcional desenvolvido para digitalizar o processo de entrada e saída de alunos, garantindo que cada movimentação seja pré-autorizada pelo Analista de Qualidade de Vida (AQV) e validada na portaria.

## 2. Tecnologias Utilizadas
- **Backend:** Laravel 11 (PHP) - Atuando como API REST.
- **Frontend:** Svelte 5 com Tailwind CSS e Bits UI.
- **Banco de Dados:** SQLite/MySQL (conforme configuração local).
- **Simulação de Notificações:** Laravel Logs (`storage/logs/laravel.log`).

## 3. Fluxo de Operação

### Passo 1: Login
Acesse o sistema com as credenciais de teste fornecidas na tela de login:
- **AQV:** `aqv@safe.com` | senha: `password`
- **Portaria:** `portaria@safe.com` | senha: `password`

### Passo 2: Pré-Autorização (Analista AQV)
1. O analista preenche o nome do aluno, turma e o tipo de fluxo (Entrada Tardia ou Saída Antecipada).
2. Ao clicar em "Registrar", o pedido é enviado para a fila da portaria.

### Passo 3: Validação (Portaria)
1. O porteiro visualiza em tempo real os alunos que possuem autorização.
2. Ao confirmar a passagem do aluno, o porteiro clica em "Validar".
3. O sistema marca o fluxo como concluído.

### Passo 4: Notificação (Simulação)
No momento da validação, o sistema dispara um evento que gera um log. Para visualizar a simulação da notificação enviada aos pais, verifique o arquivo:
`backend/storage/logs/laravel.log`

Exemplo de Log:
`[2026-05-22] local.INFO: NOTIFICAÇÃO SAFE: Aluno João Silva realizou saida em 2026-05-22 14:00:00`

## 4. Guia de Instalação (Desenvolvedor)

### Backend
1. Navegue até `/backend`.
2. Execute `composer install` (conforme seu ambiente).
3. Configure o `.env` (DB e App Key).
4. Execute `php artisan migrate:fresh --seed` para criar as tabelas e usuários de teste.
5. Inicie o servidor: `php artisan serve`.

### Frontend
1. Navegue até `/frontend`.
2. Execute `npm install`.
3. Inicie o servidor de desenvolvimento: `npm run dev`.
4. Acesse `http://localhost:5173`.

---
*Desenvolvido como protótipo para o Desafio SAFE 2026.*
