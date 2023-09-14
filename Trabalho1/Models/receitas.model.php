<?php

class ReceitaModel {
    
    // Função para adicionar uma nova receita
    public static function adicionarReceita($nome, $ingredientes, $modo_preparo) {
        $id = uniqid();
        $_SESSION['receitas'][$id] = [
            'nome' => $nome,
            'ingredientes' => $ingredientes,
            'modo_preparo' => $modo_preparo
        ];
    }

    // Função para editar uma receita existente
    public static function editarReceita($id, $nome, $ingredientes, $modo_preparo) {
        if (isset($_SESSION['receitas'][$id])) {
            $_SESSION['receitas'][$id] = [
                'nome' => $nome,
                'ingredientes' => $ingredientes,
                'modo_preparo' => $modo_preparo
            ];
        }
    }

    // Função para obter uma receita pelo ID
    public static function getReceita($id) {
        return $_SESSION['receitas'][$id] ?? null;
    }

    // Função para excluir uma receita
    public static function excluirReceita($id) {
        if (isset($_SESSION['receitas'][$id])) {
            unset($_SESSION['receitas'][$id]);
        }
    }

    // Função para obter todas as receitas
    public static function getTodasReceitas() {
        return $_SESSION['receitas'] ?? [];
    }

    // Função para obter receitas pré-definidas
public static function getReceitasPreDefinidas() {
    return [
        'receita1' => [
            'nome' => 'Bolo de Chocolate',
            'ingredientes' => 'Farinha, açúcar, chocolate, etc.',
            'modo_preparo' => 'Misture tudo e asse por 40 minutos.'
        ],
        'receita2' => [
            'nome' => 'Torta de Maçã',
            'ingredientes' => 'Massa, maçãs, açúcar, canela, etc.',
            'modo_preparo' => 'Preparar a massa, rechear com maçãs e assar por 50 minutos.'
        ],
        'receita3' => [
            'nome' => 'Lasanha à Bolonhesa',
            'ingredientes' => 'Massa de lasanha, carne moída, molho de tomate, queijo, etc.',
            'modo_preparo' => 'Montar camadas intercalando massa, molho, carne e queijo. Assar por 45 minutos.'
        ],
        'receita4' => [
            'nome' => 'Strogonoff de Frango',
            'ingredientes' => 'Frango em cubos, creme de leite, ketchup, mostarda, etc.',
            'modo_preparo' => 'Refogar o frango, adicionar os molhos e finalizar com o creme de leite.'
        ],
        'receita5' => [
            'nome' => 'Salada Caesar',
            'ingredientes' => 'Alface, croutons, frango grelhado, molho Caesar, queijo parmesão, etc.',
            'modo_preparo' => 'Misturar todos os ingredientes em uma tigela grande e servir com molho Caesar.'
        ]
    ];
}
}
