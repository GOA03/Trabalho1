<?php

//Incluindo o modelo de receitas
include_once "../Models/receitas.model.php";

class ReceitasController {
    
    //Função para adicionar uma receita
    public static function adicionar() {
        if (isset($_POST['nome'], $_POST['ingredientes'], $_POST['modo_preparo'])) { //Se as variáveis foram definidas e não são nulas então 
            $nome = strip_tags(trim($_POST['nome']));
            $ingredientes = strip_tags(trim($_POST['ingredientes']));
            $modo_preparo = strip_tags(trim($_POST['modo_preparo']));
            
            ReceitaModel::adicionarReceita($nome, $ingredientes, $modo_preparo);
            
            header('Location: listar.view.php');
            exit();
        }
    }

    // Função para editar uma receita
    public static function editar() {
        if (isset($_POST['id'], $_POST['nome'], $_POST['ingredientes'], $_POST['modo_preparo'])) {
            $id = $_POST['id'];
            $nome = strip_tags(trim($_POST['nome']));
            $ingredientes = strip_tags(trim($_POST['ingredientes']));
            $modo_preparo = strip_tags(trim($_POST['modo_preparo']));

            ReceitaModel::editarReceita($id, $nome, $ingredientes, $modo_preparo);
            
            header('Location: listar.view.php');
            exit();
        }
    }

    // Função para excluir uma receita
    public static function excluir() {
        if (isset($_GET['action']) && $_GET['action'] === 'excluir' && isset($_GET['id'])) {
            $id = $_GET['id'];
            ReceitaModel::excluirReceita($id);
            header('Location: listar.view.php');
            exit();
        }        
    }
    
    // Função para listar todas as receitas
    public static function listar() {
        $receitas = ReceitaModel::getTodasReceitas();
        return $receitas;
    }
    
    // Função para inicializar receitas pré-definidas (se não existirem)
    public static function inicializarReceitasPreDefinidas() {
        if(empty($_SESSION['receitas'])) {
            $receitasPreDefinidas = ReceitaModel::getReceitasPreDefinidas();
            foreach ($receitasPreDefinidas as $receita) {
                ReceitaModel::adicionarReceita($receita['nome'], $receita['ingredientes'], $receita['modo_preparo']);
            }
        }
    }
}

// Inicializando as receitas pré-definidas
ReceitasController::inicializarReceitasPreDefinidas();
