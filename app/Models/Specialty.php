<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Specialty
 *
 * @property int $id
 * @property string $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Collection|ProfessionalSpecialty[] $professional_specialties
 *
 * @package App\Models
 */
class Specialty extends Model
{
    use HasFactory;

    protected $table = 'specialties';

    protected $fillable = [
        'name'
    ];

    public function professional_specialties()
    {
        return $this->hasMany(ProfessionalSpecialty::class);
    }

    public function professionals()
    {
        return $this->belongsToMany(Professional::class, 'professional_specialties', 'specialty_id', 'professional_id');
    }
}
