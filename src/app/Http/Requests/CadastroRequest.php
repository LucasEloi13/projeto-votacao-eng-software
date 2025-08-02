<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CadastroRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'nome' => 'required|string|max:100',
            'email' => 'required|email|max:100|unique:usuarios,email',
            'telefone' => 'nullable|string|max:20',
            'cpf' => 'required|string|size:14|unique:usuarios,cpf',
            'senha' => 'required|string|min:6|confirmed',
            'tipo_usuario' => 'in:morador', // Apenas morador é permitido
            'terms' => 'required|accepted',
        ];
    }

    /**
     * Get custom error messages for validation rules.
     */
    public function messages(): array
    {
        return [
            'nome.required' => 'O nome é obrigatório.',
            'nome.max' => 'O nome não pode ter mais de 100 caracteres.',
            
            'email.required' => 'O e-mail é obrigatório.',
            'email.email' => 'Formato de e-mail inválido.',
            'email.unique' => 'Este e-mail já está cadastrado.',
            'email.max' => 'O e-mail não pode ter mais de 100 caracteres.',
            
            'telefone.max' => 'O telefone não pode ter mais de 20 caracteres.',
            
            'cpf.required' => 'O CPF é obrigatório.',
            'cpf.size' => 'O CPF deve ter 14 caracteres (com pontos e traço).',
            'cpf.unique' => 'Este CPF já está cadastrado.',
            
            'senha.required' => 'A senha é obrigatória.',
            'senha.min' => 'A senha deve ter pelo menos 6 caracteres.',
            'senha.confirmed' => 'A confirmação da senha não confere.',
            
            'terms.required' => 'Você deve aceitar os termos de uso.',
            'terms.accepted' => 'Você deve aceitar os termos de uso.',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        // Remove caracteres especiais do CPF para validação
        if ($this->cpf) {
            $this->merge([
                'cpf_clean' => preg_replace('/[^0-9]/', '', $this->cpf)
            ]);
        }

        // Garantir que o tipo de usuário seja sempre "morador"
        $this->merge([
            'tipo_usuario' => 'morador'
        ]);
    }

    /**
     * Configure the validator instance.
     */
    public function withValidator($validator): void
    {
        $validator->after(function ($validator) {
            // Validação customizada do CPF
            if ($this->cpf && !$this->isValidCPF($this->cpf)) {
                $validator->errors()->add('cpf', 'CPF inválido.');
            }
        });
    }

    /**
     * Valida se o CPF é válido
     */
    private function isValidCPF($cpf): bool
    {
        // Remove caracteres especiais
        $cpf = preg_replace('/[^0-9]/', '', $cpf);
        
        // Verifica se tem 11 dígitos
        if (strlen($cpf) != 11) {
            return false;
        }
        
        // Verifica se todos os dígitos são iguais
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }
        
        // Calcula os dígitos verificadores
        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                return false;
            }
        }
        
        return true;
    }
}
