// Sistema de Votação de Ideias - JavaScript Principal

document.addEventListener('DOMContentLoaded', function() {
    // Inicializar funcionalidades
    initVotingSystem();
    initFormValidation();
    initTooltips();
    
    console.log('Sistema de Votação carregado com sucesso!');
});

// Sistema de Votação AJAX
function initVotingSystem() {
    const votoForms = document.querySelectorAll('.voto-form');
    
    votoForms.forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const ideiaId = this.dataset.ideiaId;
            const button = this.querySelector('button');
            
            if (!ideiaId) {
                console.error('ID da ideia não encontrado');
                return;
            }
            
            // Adicionar estado de loading
            const originalText = button.innerHTML;
            button.classList.add('loading');
            button.disabled = true;
            
            // Fazer requisição AJAX
            fetch('index.php?controller=voto&action=alternar', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: `ideia_id=${ideiaId}`
            })
            .then(response => response.json())
            .then(data => {
                if (data.sucesso) {
                    // Atualizar interface
                    updateVoteButton(button, data.usuario_ja_votou);
                    updateVoteCount(ideiaId, data.total_votos);
                    
                    // Mostrar mensagem de sucesso
                    showToast('success', data.mensagem);
                } else {
                    showToast('error', data.erro);
                    console.error('Erro ao votar:', data.erro);
                }
            })
            .catch(error => {
                console.error('Erro na requisição:', error);
                showToast('error', 'Erro ao processar voto. Tente novamente.');
            })
            .finally(() => {
                // Remover estado de loading
                button.classList.remove('loading');
                button.disabled = false;
                button.innerHTML = originalText;
            });
        });
    });
}

// Atualizar botão de voto
function updateVoteButton(button, userVoted) {
    if (userVoted) {
        button.className = 'btn btn-danger btn-sm';
        button.innerHTML = '❤️';
        button.title = 'Remover voto';
    } else {
        button.className = 'btn btn-outline-danger btn-sm';
        button.innerHTML = '🤍';
        button.title = 'Votar nesta ideia';
    }
}

// Atualizar contador de votos
function updateVoteCount(ideiaId, totalVotos) {
    // Procurar por elementos que mostram o total de votos para esta ideia
    const voteCounters = document.querySelectorAll('.total-votos');
    
    voteCounters.forEach(counter => {
        const card = counter.closest('.card');
        if (card && card.querySelector(`[data-ideia-id="${ideiaId}"]`)) {
            counter.textContent = totalVotos;
            
            // Adicionar animação ao contador
            counter.style.transform = 'scale(1.2)';
            setTimeout(() => {
                counter.style.transform = 'scale(1)';
            }, 200);
        }
    });
}

// Sistema de validação de formulários
function initFormValidation() {
    const forms = document.querySelectorAll('form[method="POST"]');
    
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            if (!validateForm(this)) {
                e.preventDefault();
            }
        });
        
        // Validação em tempo real
        const inputs = form.querySelectorAll('input, textarea');
        inputs.forEach(input => {
            input.addEventListener('blur', function() {
                validateField(this);
            });
        });
    });
}

// Validar formulário completo
function validateForm(form) {
    let isValid = true;
    const inputs = form.querySelectorAll('input[required], textarea[required]');
    
    inputs.forEach(input => {
        if (!validateField(input)) {
            isValid = false;
        }
    });
    
    // Validações específicas
    const senhaInput = form.querySelector('input[name="senha"]');
    const confirmarSenhaInput = form.querySelector('input[name="confirmar_senha"]');
    
    if (senhaInput && confirmarSenhaInput) {
        if (senhaInput.value !== confirmarSenhaInput.value) {
            showFieldError(confirmarSenhaInput, 'As senhas não coincidem');
            isValid = false;
        }
    }
    
    return isValid;
}

// Validar campo individual
function validateField(field) {
    const value = field.value.trim();
    let isValid = true;
    
    // Limpar erros anteriores
    clearFieldError(field);
    
    // Campo obrigatório
    if (field.hasAttribute('required') && !value) {
        showFieldError(field, 'Este campo é obrigatório');
        isValid = false;
    }
    
    // Validação de email
    if (field.type === 'email' && value) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(value)) {
            showFieldError(field, 'Email inválido');
            isValid = false;
        }
    }
    
    // Validação de senha
    if (field.name === 'senha' && value && value.length < 6) {
        showFieldError(field, 'A senha deve ter pelo menos 6 caracteres');
        isValid = false;
    }
    
    // Validação de título
    if (field.name === 'titulo' && value && value.length > 150) {
        showFieldError(field, 'O título deve ter no máximo 150 caracteres');
        isValid = false;
    }
    
    // Validação de descrição
    if (field.name === 'descricao' && value && value.length < 10) {
        showFieldError(field, 'A descrição deve ter pelo menos 10 caracteres');
        isValid = false;
    }
    
    return isValid;
}

// Mostrar erro em campo
function showFieldError(field, message) {
    field.classList.add('is-invalid');
    
    let errorDiv = field.nextElementSibling;
    if (!errorDiv || !errorDiv.classList.contains('invalid-feedback')) {
        errorDiv = document.createElement('div');
        errorDiv.className = 'invalid-feedback';
        field.parentNode.insertBefore(errorDiv, field.nextSibling);
    }
    
    errorDiv.textContent = message;
}

// Limpar erro de campo
function clearFieldError(field) {
    field.classList.remove('is-invalid');
    
    const errorDiv = field.nextElementSibling;
    if (errorDiv && errorDiv.classList.contains('invalid-feedback')) {
        errorDiv.remove();
    }
}

// Sistema de notificações toast
function showToast(type, message) {
    const toastContainer = getOrCreateToastContainer();
    
    const toast = document.createElement('div');
    toast.className = `toast align-items-center text-white bg-${type === 'success' ? 'success' : 'danger'} border-0`;
    toast.setAttribute('role', 'alert');
    toast.innerHTML = `
        <div class="d-flex">
            <div class="toast-body">
                ${message}
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
        </div>
    `;
    
    toastContainer.appendChild(toast);
    
    const bsToast = new bootstrap.Toast(toast);
    bsToast.show();
    
    // Remover toast após ser ocultado
    toast.addEventListener('hidden.bs.toast', () => {
        toast.remove();
    });
}

// Obter ou criar container de toasts
function getOrCreateToastContainer() {
    let container = document.querySelector('.toast-container');
    
    if (!container) {
        container = document.createElement('div');
        container.className = 'toast-container position-fixed bottom-0 end-0 p-3';
        document.body.appendChild(container);
    }
    
    return container;
}

// Inicializar tooltips do Bootstrap
function initTooltips() {
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
}

// Utilitários adicionais

// Confirmar ação
function confirmAction(message) {
    return confirm(message || 'Tem certeza que deseja continuar?');
}

// Formatar data
function formatDate(dateString) {
    const date = new Date(dateString);
    return date.toLocaleDateString('pt-BR', {
        year: 'numeric',
        month: 'short',
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
    });
}

// Truncar texto
function truncateText(text, maxLength = 100) {
    if (text.length <= maxLength) return text;
    return text.substr(0, maxLength) + '...';
}

// Debug mode (ativar apenas em desenvolvimento)
const DEBUG_MODE = false;

if (DEBUG_MODE) {
    console.log('Modo debug ativado');
    
    // Log de todas as requisições AJAX
    const originalFetch = window.fetch;
    window.fetch = function(...args) {
        console.log('Fetch request:', args);
        return originalFetch.apply(this, args)
            .then(response => {
                console.log('Fetch response:', response);
                return response;
            });
    };
}