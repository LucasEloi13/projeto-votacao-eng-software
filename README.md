# FastAPI + Vue.js + MySQL - DevContainer Setup

Stack completa com FastAPI (backend), Vue.js (frontend) e MySQL usando VS Code DevContainers.

## Pré-requisitos

- VS Code instalado
- Extensão **Dev Containers** instalada no VS Code
- Docker Desktop instalado e rodando

## 1. Preparar o Projeto

### 1.1. Estrutura de pastas
```
meu-projeto/
├── .devcontainer/
│   ├── devcontainer.json
│   ├── docker-compose.yml
│   └── Dockerfile
└── requirements.txt
```

### 1.2. Arquivos do DevContainer

**`.devcontainer/devcontainer.json`**
```json
{
  "name": "FastAPI + Vue.js + MySQL",
  "dockerComposeFile": "docker-compose.yml",
  "service": "app",
  "workspaceFolder": "/workspace",
  "customizations": {
    "vscode": {
      "extensions": [
        "ms-python.python",
        "Vue.volar",
        "ms-vscode.vscode-json"
      ]
    }
  },
  "postCreateCommand": "pip install -r requirements.txt",
  "forwardPorts": [8000, 3000, 3306]
}
```

**`.devcontainer/docker-compose.yml`**
```yaml
version: '3.8'

services:
  app:
    build: .
    volumes:
      - ../..:/workspace:cached
    command: sleep infinity
    network_mode: service:db
    depends_on:
      - db

  db:
    image: mysql:8.0
    environment:
      MYSQL_ROOT_PASSWORD: root
      MYSQL_DATABASE: app
    ports:
      - "3306:3306"
    volumes:
      - mysql_data:/var/lib/mysql

volumes:
  mysql_data:
```

**`.devcontainer/Dockerfile`**
```dockerfile
FROM python:3.11-slim

RUN apt-get update && apt-get install -y \
    nodejs npm git curl \
    && rm -rf /var/lib/apt/lists/*

WORKDIR /workspace
```

**`requirements.txt`**
```
fastapi==0.104.1
uvicorn[standard]==0.24.0
pymysql==1.1.0
sqlalchemy==2.0.23
```

## 2. Iniciar o DevContainer

### 2.1. Abrir o projeto
```bash
code meu-projeto
```

### 2.2. Abrir no Container
- Pressione `Ctrl+Shift+P` (ou `Cmd+Shift+P` no Mac)
- Digite: `Dev Containers: Reopen in Container`
- Aguarde o container ser construído

## 3. Configurar o Projeto

### 3.1. Criar o frontend Vue.js
```bash
# Instalar Vue CLI
npm install -g @vue/cli

# Criar projeto
vue create frontend
# Escolha: Default ([Vue 3] babel, eslint)

# Instalar axios
cd frontend
npm install axios
cd ..
```

### 3.2. Criar o backend FastAPI
```bash
mkdir backend
cd backend
```

**`backend/main.py`**
```python
from fastapi import FastAPI
from fastapi.middleware.cors import CORSMiddleware

app = FastAPI()

# Configurar CORS
app.add_middleware(
    CORSMiddleware,
    allow_origins=["http://localhost:3000"],
    allow_credentials=True,
    allow_methods=["*"],
    allow_headers=["*"],
)

@app.get("/")
def read_root():
    return {"message": "Hello from FastAPI!"}

@app.get("/api/test")
def test_endpoint():
    return {"status": "API funcionando!", "database": "MySQL conectado"}
```

### 3.3. Configurar MySQL (opcional)

**`backend/database.py`**
```python
from sqlalchemy import create_engine
from sqlalchemy.ext.declarative import declarative_base
from sqlalchemy.orm import sessionmaker

SQLALCHEMY_DATABASE_URL = "mysql+pymysql://root:root@localhost:3306/app"

engine = create_engine(SQLALCHEMY_DATABASE_URL)
SessionLocal = sessionmaker(autocommit=False, autoflush=False, bind=engine)
Base = declarative_base()

def get_db():
    db = SessionLocal()
    try:
        yield db
    finally:
        db.close()
```

## 4. Executar o Projeto

### 4.1. Terminal 1 - FastAPI
```bash
cd backend
uvicorn main:app --reload --host 0.0.0.0 --port 8000
```

### 4.2. Terminal 2 - Vue.js
```bash
cd frontend
npm run serve
```

### 4.3. Terminal 3 - MySQL (opcional)
```bash
mysql -h localhost -u root -p
# Senha: root
```

## 5. URLs de Acesso

- **Frontend**: http://localhost:3000
- **Backend API**: http://localhost:8000
- **API Docs**: http://localhost:8000/docs
- **MySQL**: localhost:3306

## 6. Teste de Integração

Edite `frontend/src/App.vue` para testar a conexão:

```vue
<template>
  <div id="app">
    <h1>Meu Projeto Full Stack</h1>
    <button @click="testarAPI">Testar API</button>
    <p v-if="resposta">{{ resposta }}</p>
  </div>
</template>

<script>
import axios from 'axios'

export default {
  name: 'App',
  data() {
    return {
      resposta: null
    }
  },
  methods: {
    async testarAPI() {
      try {
        const response = await axios.get('http://localhost:8000/api/test')
        this.resposta = response.data.status
      } catch (error) {
        console.error('Erro:', error)
        this.resposta = 'Erro ao conectar com a API'
      }
    }
  }
}
</script>
```

## 7. Estrutura Final

```
meu-projeto/
├── .devcontainer/
│   ├── devcontainer.json
│   ├── docker-compose.yml
│   └── Dockerfile
├── backend/
│   ├── main.py
│   └── database.py
├── frontend/
│   ├── src/
│   ├── public/
│   ├── package.json
│   └── ...
├── requirements.txt
└── README.md
```

## Tecnologias

- **Backend**: FastAPI + Python 3.11
- **Frontend**: Vue.js 3 + Axios
- **Database**: MySQL 8.0
- **DevContainer**: Docker + VS Code

## Comandos Úteis

```bash
# Parar os serviços
Ctrl+C

# Reconstruir container
Ctrl+Shift+P → "Dev Containers: Rebuild Container"

# Acessar MySQL
mysql -h localhost -u root -p

# Logs do container
docker-compose logs
```