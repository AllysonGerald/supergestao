/**
 * Aplicação automática de máscaras baseado em atributos data-*
 * 
 * Uso no HTML:
 * <input type="text" data-mask="cpf" />
 * <input type="text" data-mask="cnpj" />
 * <input type="text" data-mask="cpf-cnpj" />
 * <input type="text" data-mask="cep" data-cep-autofill />
 * <input type="text" data-mask="phone" />
 * <input type="text" data-mask="currency" />
 */

import {
    applyCpfMask,
    applyCnpjMask,
    applyCpfCnpjMask,
    applyCepMask,
    applyPhoneMask,
    applyCurrencyMask,
    autoFillAddressByCep
} from './masks/index.js';

export function initMasks() {
    // CPF
    document.querySelectorAll('[data-mask="cpf"]').forEach(input => {
        applyCpfMask(input);
    });
    
    // CNPJ
    document.querySelectorAll('[data-mask="cnpj"]').forEach(input => {
        applyCnpjMask(input);
    });
    
    // CPF/CNPJ Dinâmico
    document.querySelectorAll('[data-mask="cpf-cnpj"]').forEach(input => {
        applyCpfCnpjMask(input);
    });
    
    // CEP
    document.querySelectorAll('[data-mask="cep"]').forEach(input => {
        applyCepMask(input);
        
        // Auto-preenchimento de endereço
        if (input.hasAttribute('data-cep-autofill')) {
            input.addEventListener('blur', async (e) => {
                const cep = e.target.value;
                
                if (cep.replace(/\D/g, '').length === 8) {
                    const form = input.closest('form');
                    
                    if (form) {
                        const fields = {
                            endereco: form.querySelector('[name="endereco"]'),
                            bairro: form.querySelector('[name="bairro"]'),
                            cidade: form.querySelector('[name="cidade"]'),
                            estado: form.querySelector('[name="estado"]'),
                            complemento: form.querySelector('[name="complemento"]'),
                            numero: form.querySelector('[name="numero"]')
                        };
                        
                        try {
                            // Adiciona loading no input
                            input.classList.add('loading');
                            
                            await autoFillAddressByCep(cep, fields);
                            
                            // Remove loading
                            input.classList.remove('loading');
                            
                            // Feedback visual de sucesso
                            input.classList.add('border-green-500');
                            setTimeout(() => {
                                input.classList.remove('border-green-500');
                            }, 2000);
                        } catch (error) {
                            // Remove loading
                            input.classList.remove('loading');
                            
                            // Feedback visual de erro
                            input.classList.add('border-red-500');
                            setTimeout(() => {
                                input.classList.remove('border-red-500');
                            }, 2000);
                            
                            console.error('Erro ao buscar CEP:', error);
                        }
                    }
                }
            });
        }
    });
    
    // Telefone
    document.querySelectorAll('[data-mask="phone"]').forEach(input => {
        applyPhoneMask(input);
    });
    
    // Moeda/Currency
    document.querySelectorAll('[data-mask="currency"]').forEach(input => {
        applyCurrencyMask(input);
    });
}

// Inicializa as máscaras quando o DOM estiver pronto
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initMasks);
} else {
    initMasks();
}

// Observer para elementos adicionados dinamicamente (Alpine.js, AJAX, etc)
if (typeof MutationObserver !== 'undefined') {
    const observer = new MutationObserver((mutations) => {
        mutations.forEach((mutation) => {
            mutation.addedNodes.forEach((node) => {
                if (node.nodeType === 1) { // Element node
                    // Verifica se o próprio nó tem data-mask
                    if (node.hasAttribute && node.hasAttribute('data-mask')) {
                        applyMaskToElement(node);
                    }
                    
                    // Verifica filhos
                    if (node.querySelectorAll) {
                        const maskedElements = node.querySelectorAll('[data-mask]');
                        maskedElements.forEach(el => applyMaskToElement(el));
                    }
                }
            });
        });
    });
    
    observer.observe(document.body, {
        childList: true,
        subtree: true
    });
}

// Função auxiliar para aplicar máscara em um elemento específico
function applyMaskToElement(element) {
    const maskType = element.getAttribute('data-mask');
    
    switch(maskType) {
        case 'cpf':
            applyCpfMask(element);
            break;
        case 'cnpj':
            applyCnpjMask(element);
            break;
        case 'cpf-cnpj':
            applyCpfCnpjMask(element);
            break;
        case 'cep':
            applyCepMask(element);
            if (element.hasAttribute('data-cep-autofill')) {
                // Adiciona listener de autofill
                element.addEventListener('blur', async (e) => {
                    const cep = e.target.value;
                    if (cep.replace(/\D/g, '').length === 8) {
                        const form = element.closest('form');
                        if (form) {
                            const fields = {
                                endereco: form.querySelector('[name="endereco"]'),
                                bairro: form.querySelector('[name="bairro"]'),
                                cidade: form.querySelector('[name="cidade"]'),
                                estado: form.querySelector('[name="estado"]'),
                                complemento: form.querySelector('[name="complemento"]'),
                                numero: form.querySelector('[name="numero"]')
                            };
                            
                            try {
                                element.classList.add('loading');
                                await autoFillAddressByCep(cep, fields);
                                element.classList.remove('loading');
                                element.classList.add('border-green-500');
                                setTimeout(() => element.classList.remove('border-green-500'), 2000);
                            } catch (error) {
                                element.classList.remove('loading');
                                element.classList.add('border-red-500');
                                setTimeout(() => element.classList.remove('border-red-500'), 2000);
                                console.error('Erro ao buscar CEP:', error);
                            }
                        }
                    }
                });
            }
            break;
        case 'phone':
            applyPhoneMask(element);
            break;
        case 'currency':
            applyCurrencyMask(element);
            break;
    }
}

// Disponibiliza globalmente para uso manual se necessário
window.applyMaskToElement = applyMaskToElement;
window.initMasks = initMasks;

// Exporta para reinicializar após carregamento dinâmico
export default initMasks;

