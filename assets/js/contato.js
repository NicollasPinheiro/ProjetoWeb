document.addEventListener('DOMContentLoaded', function() {
    const formContato = document.getElementById('formContato');
    if (!formContato) return;
    
    const btnEnviar = formContato.querySelector('.btn-submit');
    const statusEnvio = document.getElementById('statusEnvioContato');
    
    const nomeInput = document.getElementById('nome');
    const emailInput = document.getElementById('email');
    const assuntoInput = document.getElementById('assunto');
    const mensagemInput = document.getElementById('mensagem');
    
    const erroNome = document.getElementById('erroNome');
    const erroEmail = document.getElementById('erroEmail');
    const erroAssunto = document.getElementById('erroAssunto');
    const erroMensagem = document.getElementById('erroMensagem');

    formContato.addEventListener('submit', async function(e) {
        e.preventDefault();

        if (erroNome) erroNome.textContent = '';
        if (erroEmail) erroEmail.textContent = '';
        if (erroAssunto) erroAssunto.textContent = '';
        if (erroMensagem) erroMensagem.textContent = '';
        if (statusEnvio) {
            statusEnvio.textContent = '';
            statusEnvio.className = 'status-mensagem';
        }

        const nome = nomeInput.value.trim();
        const email = emailInput.value.trim();
        const assunto = assuntoInput.value.trim();
        const mensagem = mensagemInput.value.trim();

        let valido = true;

        if (nome === '') {
            if (erroNome) erroNome.textContent = 'Informe seu nome.';
            nomeInput.classList.add('campo-invalido');
            valido = false;
        } else {
            nomeInput.classList.remove('campo-invalido');
        }

        if (email === '') {
            if (erroEmail) erroEmail.textContent = 'Informe seu e-mail.';
            emailInput.classList.add('campo-invalido');
            valido = false;
        } else if (!validarEmail(email)) {
            if (erroEmail) erroEmail.textContent = 'E-mail inválido.';
            emailInput.classList.add('campo-invalido');
            valido = false;
        } else {
            emailInput.classList.remove('campo-invalido');
        }

        if (assunto === '') {
            if (erroAssunto) erroAssunto.textContent = 'Informe o assunto.';
            assuntoInput.classList.add('campo-invalido');
            valido = false;
        } else {
            assuntoInput.classList.remove('campo-invalido');
        }

        if (mensagem === '') {
            if (erroMensagem) erroMensagem.textContent = 'Informe sua mensagem.';
            mensagemInput.classList.add('campo-invalido');
            valido = false;
        } else {
            mensagemInput.classList.remove('campo-invalido');
        }

        if (!valido) return;

        btnEnviar.disabled = true;
        const textoOriginal = btnEnviar.textContent;
        btnEnviar.textContent = 'Enviando...';

        try {
            const formData = new FormData(formContato);
            const response = await fetch('phpmailer/enviar-contato.php', {
                method: 'POST',
                body: formData
            });

            const data = await response.json();

            if (data.success) {
                statusEnvio.className = 'status-mensagem sucesso';
                statusEnvio.textContent = '✅ ' + data.message;
                formContato.reset();
            } else {
                statusEnvio.className = 'status-mensagem falha';
                statusEnvio.textContent = '❌ ' + data.message;
            }

        } catch (error) {
            statusEnvio.className = 'status-mensagem falha';
            statusEnvio.textContent = '❌ Erro de conexão. Tente novamente.';
            console.error('Erro:', error);
        } finally {
            btnEnviar.disabled = false;
            btnEnviar.textContent = textoOriginal;
        }
    });

    function validarEmail(email) {
        const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return regex.test(email);
    }

    [nomeInput, emailInput, assuntoInput, mensagemInput].forEach(input => {
        if (input) {
            input.addEventListener('input', function() {
                this.classList.remove('campo-invalido');
                const erroId = 'erro' + this.id.charAt(0).toUpperCase() + this.id.slice(1);
                const erroSpan = document.getElementById(erroId);
                if (erroSpan) erroSpan.textContent = '';
            });
        }
    });
});