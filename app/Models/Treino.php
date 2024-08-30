<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Treino extends Model
{
    use HasFactory;

    protected $table = 'treinos';

    protected $fillabel = [
        'nome',
        'descricao',
    ];

    /* 
    * Relacionamentos
    */
    public function instrutor(): BelongsTo
    {
        return $this->belongsTo(Instrutor::class, 'instrutor_id'); // plural irregular
    }

    public function exercicios(): BelongsToMany
    {
        return $this->belongsToMany(Exercicio::class)->withPivot('intensidade');
    }

    public function alunos(): BelongsToMany
    {
        return $this->belongsToMany(Aluno::class)
            ->using(AlunoTreino::class)
            ->withPivot('exercicios_feitos', 'exercicios_totais', 'finalizado_em')
            ->withTimestamps('criado_em', 'atualizado_em');
    }
}
