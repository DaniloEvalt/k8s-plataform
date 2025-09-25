# Kubernetes PHP Application Stack

Este repositório contém a infraestrutura como código para uma aplicação PHP rodando em Kubernetes.

## Estrutura do Projeto

```
.
├── apps/                    # Aplicações
├── infrastructure/         
│   ├── monitoring/         # Prometheus + Grafana
│   ├── ingress/           # Nginx Ingress Controller
│   ├── cache/             # Varnish
│   └── database/          # Banco de dados
├── argocd-application.yaml # Configuração do ArgoCD
└── namespace.yaml         # Definição do namespace
```

## Componentes

- **Nginx Ingress Controller**: Gerenciamento de tráfego de entrada
- **Varnish**: Cache HTTP
- **PHP-FPM + Apache**: Aplicação PHP 8.2
- **Banco de dados**: Persistência de dados
- **Prometheus + Grafana**: Monitoramento e visualização

## Pré-requisitos

- Kubernetes cluster v1.24+
- ArgoCD instalado no cluster
- Helm v3+

## Instalação

1. Clone este repositório
2. Atualize o `repoURL` no arquivo `argocd-application.yaml` com seu repositório Git
3. Aplique a configuração do ArgoCD:

```bash
kubectl apply -f infrastructure/argocd-application.yaml
```

## Monitoramento

O stack de monitoramento inclui:
- Prometheus para coleta de métricas
- Grafana para visualização
- Dashboards pré-configurados para PHP, Nginx, Varnish e infraestrutura

## GitOps com ArgoCD

Este projeto utiliza ArgoCD para implementar GitOps, garantindo que o estado do cluster sempre reflita o código no repositório Git.
