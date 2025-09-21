<?php

namespace Models;

class Comentario {
    public $id;
    public $ideia_id;
    public $usuario_id;
    public $texto;
    public $criado_em;
    // Opcional: nome do usuário para exibir junto ao comentário
    public $nome_usuario;
}
