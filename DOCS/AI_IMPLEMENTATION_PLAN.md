# Implementation Plan: DSITD AI Assistant (Laravel + n8n RAG Orchestration)

This document outlines the hybrid architecture combining Laravel as the core CMS and **n8n** as the AI Orchestration layer for building a Multimodal RAG system.

## 1. Technical Architecture: The Hybrid Flow

The workflow is split between the **Application Layer (Laravel)** and the **AI Intelligence Layer (n8n)**.

### A. Data Ingestion (Indexing)
1. **Trigger**: Admin saves News, Documents, or Gallery items in Laravel.
2. **Action**: Laravel emits a Webhook to n8n with the content/file URL.
3. **n8n Processing**:
   - Downloads/Parses the document (PDF, Docx) or Image.
   - Chunks text into semantic segments.
   - Generates Embeddings via Gemini API.
   - Saves to **Vector Store** (Suppabase/Pinecone).

### B. Chat Query (Retrieval)
1. **User Input**: Visitors ask a question via Livewire Chat UI.
2. **Request**: Laravel forwards the message to a "n8n Chat Agent" endpoint.
3. **n8n Intelligence**:
   - Performs a similarity search in the Vector Store.
   - Feeds retrieved context + history to **Gemini 1.5 Flash**.
   - Returns a structured JSON response (answer + source citations).

## 2. Updated Technology Stack

| Component | Technology | Role |
| :--- | :--- | :--- |
| **Orchestrator** | **n8n (Self-hosted/Cloud)** | AI Workflow management, PDF parsing, and RAG logic. |
| **LLM / Vision** | **Google Gemini 1.5 Flash** | Intelligence engine for text and image analysis. |
| **Vector DB** | **Pinecone** or **Supabase (pgvector)** | Storage for high-dimensional semantic search. |
| **Interface** | **Laravel Livewire** | Responsive Chat UI and Webhook emitters. |
| **Comm Layer** | **REST API / Webhooks** | Secure communication between Laravel and n8n. |

## 3. Implementation Phases

### Phase 1: n8n Infrastructure Setup
* **Step 1.1**: Setup n8n instance (Docker recommended for DSITD server).
* **Step 1.2**: Install LangChain dependencies within n8n.
* **Step 1.3**: Configure Credentials (Google AI Studio, Pinecone API).

### Phase 2: Knowledge Ingestion Workflow (n8n Side)
* **Step 2.1**: Create `POST /webhook/ingest` in n8n.
* **Step 2.2**: Setup **Multimodal Node**:
  - Image Path: Analyzing gallery photos for context.
  - Text Path: Recursive Character Splitting for news and docs.
* **Step 2.3**: Map to Vector Store output.

### Phase 3: Laravel Integration (Backend)
* **Step 3.1**: Create `AiService.php` in Laravel to handle Webhook calls to n8n.
* **Step 3.2**: Implement **Eloquent Observers** on `News`, `Document`, and `Gallery` models to trigger `ingest` jobs automatically.
* **Step 3.3**: Configure `.env` with `N8N_WEBHOOK_URL` and `N8N_API_KEY`.

### Phase 4: Conversational UI (Frontend)
* **Step 4.1**: Build the Livewire `ChatBot` component.
* **Step 4.2**: Implement "Message Bubbles" with markdown support and source citations.
* **Step 4.3**: Integrate "System Status" awareness (AI can tell if some services are down based on RAG data).

## 4. Why n8n?

1. **Agility**: Changing the RAG logic (e.g., adding a new database source) takes minutes, not hours of coding.
2. **Visual Debugging**: We can see exactly what context the AI is retrieving from university documents.
3. **Offloading**: Heavy PDF parsing and AI processing happen on the n8n instance, keeping the visitor's website experience fast.

## 5. Security Checklist
* **Webhook Auth**: Implement Header-based token verification between Laravel and n8n.
* **Data Privacy**: Ensure only `is_public` marked content is transmitted to the AI layer.
* **CORS**: Correctly configure allowed origins for the Chat API.
