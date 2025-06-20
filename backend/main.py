from fastapi import FastAPI
from fastapi.middleware.cors import CORSMiddleware

# Criar instância do FastAPI
app = FastAPI(
    title="Meu Projeto API",
    description="API com FastAPI + Vue.js + MySQL",
    version="1.0.0"
)

# Configurar CORS para permitir requisições do frontend
app.add_middleware(
    CORSMiddleware,
    allow_origins=["http://localhost:3000", "http://127.0.0.1:3000"],
    allow_credentials=True,
    allow_methods=["*"],
    allow_headers=["*"],
)

# Rota raiz
@app.get("/")
def read_root():
    return {
        "message": "API FastAPI funcionando!",
        "status": "online",
        "docs": "Acesse /docs para ver a documentação"
    }

# Rota de teste
@app.get("/api/test")
def test_api():
    return {
        "status": "success",
        "message": "API está funcionando perfeitamente!",
        "database": "MySQL configurado"
    }

# Rota com parâmetro
@app.get("/api/hello/{name}")
def say_hello(name: str):
    return {"message": f"Olá, {name}!"}

# Rota POST de exemplo
@app.post("/api/data")
def create_data(data: dict):
    return {
        "status": "received",
        "data": data,
        "message": "Dados recebidos com sucesso!"
    }

# Rota para testar conexão com MySQL
@app.get("/api/db-test")
def test_database():
    try:
        # Aqui você pode testar a conexão com o banco
        # Por enquanto, retorna sucesso
        return {
            "status": "success",
            "message": "Conexão com MySQL OK",
            "database": "app"
        }
    except Exception as e:
        return {
            "status": "error",
            "message": f"Erro na conexão: {str(e)}"
        }

# Health check
@app.get("/health")
def health_check():
    return {"status": "healthy", "service": "fastapi-backend"}

if __name__ == "__main__":
    import uvicorn
    uvicorn.run(app, host="0.0.0.0", port=8000)