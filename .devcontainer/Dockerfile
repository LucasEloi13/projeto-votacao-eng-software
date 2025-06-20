FROM python:3.11-slim

RUN apt-get update && apt-get install -y \
    nodejs npm git curl \
    && rm -rf /var/lib/apt/lists/*

WORKDIR /workspace