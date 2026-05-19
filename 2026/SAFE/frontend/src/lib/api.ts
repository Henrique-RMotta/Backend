// src/lib/api.ts
const API_BASE_URL = 'http://localhost:8000/api';

export interface PayloadAutorizacao {
  AUT_alunoname: string;
  AUT_alunoclass: string;
  AUT_type: 'entrada' | 'saida';
  AUT_signature_name: string;
  AUT_signature_image: string; // Assinatura digital ou hash mockado
  AUT_teacher_email: string;
  AUT_fouls?: string[] | null;
  AUT_time: string; // Formato data/hora
}

export const safeApi = {
  // Salva a pré-autorização direto no banco (AutorizacoesController@store)
  enviarPreAutorizacao: async (dados: PayloadAutorizacao) => {
    const res = await fetch(`${API_BASE_URL}/autorizacoes`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json'
      },
      body: JSON.stringify(dados)
    });
    
    if (!res.ok) {
      const errData = await res.json().catch(() => ({}));
      throw new Error(errData.erro || 'Erro ao processar autorização no servidor.');
    }
    return res.json();
  },

  // Dispara a validação e o desafio de notificações na Portaria (PortariaController@store)
  registrarEventoPortaria: async (alunoNome: string, tipo: 'entrada' | 'saida') => {
    const res = await fetch(`${API_BASE_URL}/portaria`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json'
      },
      body: JSON.stringify({ AUT_alunoname: alunoNome, AUT_type: tipo })
    });

    if (!res.ok) throw new Error('Falha ao registrar movimentação na portaria.');
    return res.json();
  }
};