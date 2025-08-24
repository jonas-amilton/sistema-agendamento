<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ProfessionalSpecialty
 * 
 * @property int $id
 * @property int $professional_id
 * @property int $specialty_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Professional $professional
 * @property Specialty $specialty
 *
 * @package App\Models
 */
class ProfessionalSpecialty extends Model
{
	protected $table = 'professional_specialties';

	protected $casts = [
		'professional_id' => 'int',
		'specialty_id' => 'int'
	];

	protected $fillable = [
		'professional_id',
		'specialty_id'
	];

	public function professional()
	{
		return $this->belongsTo(Professional::class);
	}

	public function specialty()
	{
		return $this->belongsTo(Specialty::class);
	}
}
