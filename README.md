# Vota Comunidade

Sistema de votação eletrônica para condomínios desenvolvido em Laravel 11, permitindo que administradores, síndicos e moradores participem de forma organizada e transparente do processo democrático condominial.

## 📋 Descrição do Projeto

O **Vota Comunidade** é uma plataforma web que digitaliza e facilita o processo de votações em condomínios, oferecendo três perfis distintos de usuários com funcionalidades específicas para cada tipo de acesso.

### Funcionalidades Principais

- **Sistema de Autenticação Multi-perfil**: Administrador, Síndico e Morador
- **Gestão de Condomínios**: Cadastro e administração completa de condomínios
- **Gestão de Usuários**: Controle de moradores, síndicos e suas aprovações
- **Sistema de Votações**: Criação, edição e gerenciamento de pautas de votação
- **Resultados em Tempo Real**: Visualização de resultados das votações
- **Interface Responsiva**: Adaptável para diferentes dispositivos

### Perfis de Usuário

#### 🔧 Administrador
- Gerenciar condomínios (criar, editar, remover)
- Gerenciar síndicos e moradores
- Aprovar/rejeitar cadastros de usuários
- Visualizar resultados de todas as votações
- Acesso completo ao sistema

#### 🏢 Síndico
- Criar e gerenciar votações do seu condomínio
- Gerenciar moradores do condomínio
- Visualizar resultados das votações
- Controlar pautas ativas e encerradas

#### 🏠 Morador
- Votar nas pautas disponíveis
- Visualizar resultados das votações
- Acessar histórico de votações encerradas
- Participar do processo democrático condominial

## 🛠️ Tecnologias Utilizadas

- **Backend**: Laravel 11 (PHP)
- **Frontend**: Blade Templates, Bootstrap 5
- **Banco de Dados**: SQLite
- **Autenticação**: Sistema de sessões personalizado
- **JavaScript**: Vanilla JS para interações dinâmicas
- **Estilização**: CSS customizado com Bootstrap

## 🎯 Arquitetura do Sistema

### Estrutura de Controllers

```
app/Http/Controllers/
├── AuthController.php              # Autenticação e login
├── CadastroController.php          # Cadastro de usuários
├── MoradorController.php           # Dashboard do morador
├── SindicoController.php           # Dashboard do síndico
├── AdminDashboardController.php    # Dashboard administrativo
├── Admin/
│   ├── GerenciarCondominiosController.php
│   ├── GerenciarSindicosController.php
│   ├── GerenciarMoradoresController.php
│   └── GerenciarResultadosController.php
├── Morador/
│   ├── VotacoesController.php
│   └── ResultadosController.php
└── Sindico/
    ├── VotacoesController.php
    ├── MoradoresController.php
    └── ResultadosController.php
```

### Estrutura de Views

```
resources/views/
├── layouts/
│   └── app.blade.php               # Layout principal
├── components/
│   ├── admin_navbar.blade.php      # Navbar do administrador
│   ├── sindico_navbar.blade.php    # Navbar do síndico
│   └── morador_navbar.blade.php    # Navbar do morador
├── admin/                          # Views do administrador
├── sindico/                        # Views do síndico
└── morador/                        # Views do morador
```

## ♿ Técnicas de Acessibilidade Implementadas

O sistema foi desenvolvido seguindo as diretrizes de acessibilidade web (WCAG 2.1) para garantir que seja utilizável por todos os usuários, incluindo pessoas com deficiências.

### 🔤 Semântica e Estrutura

#### **Elementos Semânticos HTML5**
- Uso adequado de tags semânticas: `<nav>`, `<main>`, `<section>`, `<article>`, `<header>`
- Estrutura hierárquica correta de cabeçalhos (`<h1>`, `<h2>`, `<h3>`)
- Organização lógica do conteúdo para leitores de tela

#### **ARIA (Accessible Rich Internet Applications)**
- **aria-current="page"**: Indicação da página ativa na navegação
- **aria-label**: Rótulos descritivos para elementos interativos
- **aria-describedby**: Associação de descrições a elementos de formulário
- **role="tab"**: Definição de papéis específicos para elementos interativos

### 🎨 Contraste e Visibilidade

#### **Alto Contraste de Cores**
- Proporção de contraste mínima de 4.5:1 para texto normal
- Proporção de contraste mínima de 3:1 para texto grande
- Cores consistentes e significativas em todo o sistema

#### **Estados Visuais Claros**
- Estados de hover, focus e active bem definidos
- Indicadores visuais para elementos selecionados
- Feedback visual consistente para ações do usuário

### ⌨️ Navegação por Teclado

#### **Suporte Completo ao Teclado**
- Todos os elementos interativos acessíveis via teclado
- Ordem de tabulação lógica e intuitiva
- Indicadores visuais de foco claramente visíveis

#### **Teclas de Atalho**
- Navegação padrão com Tab, Shift+Tab, Enter e Espaço
- Suporte a navegação por setas onde apropriado

### 📱 Design Responsivo e Flexível

#### **Adaptabilidade de Interface**
- Layout responsivo que funciona em diferentes tamanhos de tela
- Zoom de até 200% sem perda de funcionalidade
- Interface adaptável para diferentes dispositivos assistivos

#### **Tamanhos de Alvo Adequados**
- Botões e links com tamanho mínimo de 44x44 pixels
- Espaçamento adequado entre elementos clicáveis
- Áreas de toque generosas para dispositivos móveis

### 📝 Formulários Acessíveis

#### **Labels e Instruções Claras**
- Todos os campos de formulário possuem `<label>` associado
- Uso de `for` e `id` para associar labels aos campos
- Instruções claras e mensagens de erro descritivas

#### **Validação e Feedback**
- Mensagens de erro específicas e úteis
- Indicação visual e textual de campos obrigatórios
- Feedback imediato para ações do usuário

### 🔊 Conteúdo para Leitores de Tela

#### **Texto Alternativo**
- Textos alternativos descritivos para imagens funcionais
- Omissão de texto alt para imagens decorativas
- Descrições contextuais para elementos gráficos

#### **Estrutura Navegável**
- Landmarks ARIA para navegação eficiente
- Skip links para pular para o conteúdo principal
- Breadcrumbs para orientação na navegação

### 🎯 Interações Acessíveis

#### **Elementos Interativos Claros**
- Distinção clara entre elementos clicáveis e não-clicáveis
- Feedback tátil e visual para todas as interações
- Estados de loading e processamento claramente indicados

#### **Modais e Overlays**
- Foco adequado em modais abertas
- Possibilidade de fechar com tecla Esc
- Trap de foco em elementos sobrepostos

## 📊 Benefícios da Acessibilidade Implementada

### **Inclusão Digital**
- Sistema utilizável por pessoas com diferentes habilidades
- Compatibilidade com tecnologias assistivas
- Experiência de usuário consistente para todos

### **Usabilidade Geral**
- Interface mais intuitiva e fácil de usar
- Navegação lógica e previsível
- Feedback claro para todas as ações

### **Conformidade Legal**
- Aderência às diretrizes WCAG 2.1
- Preparação para auditorias de acessibilidade
- Demonstração de responsabilidade social

## 🚀 Como Executar o Projeto

1. **Clonar o repositório**
```bash
git clone [url-do-repositorio]
cd projeto-votacao-eng-software
```

2. **Instalar dependências**
```bash
composer install
npm install
```

3. **Configurar ambiente**
```bash
cp .env.example .env
php artisan key:generate
```

4. **Configurar banco de dados**
```bash
php artisan migrate
php artisan db:seed
```

5. **Iniciar o servidor**
```bash
php artisan serve
```

## 👥 Contribuição

Para contribuir com o projeto:

1. Fork o repositório
2. Crie uma branch para sua feature (`git checkout -b feature/AmazingFeature`)
3. Commit suas mudanças (`git commit -m 'Add some AmazingFeature'`)
4. Push para a branch (`git push origin feature/AmazingFeature`)
5. Abra um Pull Request

## 📄 Licença

Este projeto está sob a licença MIT. Veja o arquivo `LICENSE` para mais detalhes.

## 📞 Suporte

Para dúvidas, sugestões ou reportar problemas de acessibilidade, entre em contato através das issues do GitHub.

---

**Desenvolvido com foco em acessibilidade e inclusão digital** ♿
