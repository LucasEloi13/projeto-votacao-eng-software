FROM python:3.11-slim

# FastAPI backend deps
RUN apt-get update && apt-get install -y curl build-essential

# Node for frontend
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - && \
    apt-get install -y nodejs

# Set workdir
WORKDIR /workspaces/projeto-votacao-eng-software

# Install poetry/pip packages later in postCreateCommand
