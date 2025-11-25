/**
 * Máscara para CEP
 * Formato: 00000-000
 */

export function cepMask(value) {
    if (!value) return '';

    return value
        .replace(/\D/g, '')
        .replace(/(\d{5})(\d)/, '$1-$2')
        .replace(/(-\d{3})\d+?$/, '$1');
}

export function applyCepMask(input) {
    if (!input) return;

    input.addEventListener('input', (e) => {
        e.target.value = cepMask(e.target.value);
    });

    // Aplica máscara no valor inicial se existir
    if (input.value) {
        input.value = cepMask(input.value);
    }
}

export function removeCepMask(value) {
    return value ? value.replace(/\D/g, '') : '';
}

export function isValidCep(cep) {
    const cleanCep = removeCepMask(cep);
    return cleanCep.length === 8;
}

/**
 * Busca endereço pelo CEP usando ViaCEP API
 * @param {string} cep - CEP para buscar
 * @returns {Promise<object>} - Dados do endereço
 */
export async function fetchAddressByCep(cep) {
    const cleanCep = removeCepMask(cep);

    if (!isValidCep(cleanCep)) {
        throw new Error('CEP inválido');
    }

    try {
        const response = await fetch(`https://viacep.com.br/ws/${cleanCep}/json/`);
        const data = await response.json();

        if (data.erro) {
            throw new Error('CEP não encontrado');
        }

        return {
            cep: data.cep,
            logradouro: data.logradouro,
            complemento: data.complemento,
            bairro: data.bairro,
            localidade: data.localidade,
            uf: data.uf,
            ibge: data.ibge,
            gia: data.gia,
            ddd: data.ddd,
            siafi: data.siafi
        };
    } catch (error) {
        throw new Error('Erro ao buscar CEP: ' + error.message);
    }
}

/**
 * Preenche campos de endereço automaticamente baseado no CEP
 * @param {string} cep - CEP para buscar
 * @param {object} fields - Objeto com referências aos campos do formulário
 */
export async function autoFillAddressByCep(cep, fields = {}) {
    try {
        const address = await fetchAddressByCep(cep);

        if (fields.endereco && address.logradouro) {
            fields.endereco.value = address.logradouro;
        }

        if (fields.bairro && address.bairro) {
            fields.bairro.value = address.bairro;
        }

        if (fields.cidade && address.localidade) {
            fields.cidade.value = address.localidade;
        }

        if (fields.estado && address.uf) {
            fields.estado.value = address.uf;
        }

        if (fields.complemento && address.complemento) {
            fields.complemento.value = address.complemento;
        }

        // Foca no campo número após preencher
        if (fields.numero) {
            fields.numero.focus();
        }

        return address;
    } catch (error) {
        console.error('Erro ao buscar CEP:', error);
        throw error;
    }
}

