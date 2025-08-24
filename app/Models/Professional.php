<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Professional
 * 
 * @property int $id
 * @property int $clinic_id
 * @property string $first_name
 * @property string $last_name
 * @property Carbon $date_of_birth
 * @property string $cpf
 * @property string $address
 * @property string $city
 * @property string $phone
 * @property string $email
 * @property string $professional_registration_number
 * @property string $registration_entity
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Clinic $clinic
 * @property Collection|Appointment[] $appointments
 * @property Collection|ProfessionalSpecialty[] $professional_specialties
 *
 * @package App\Models
 */
class Professional extends Model
{
	protected $table = 'professionals';

	protected $casts = [
		'clinic_id' => 'int',
		'date_of_birth' => 'datetime'
	];

	protected $fillable = [
		'clinic_id',
		'first_name',
		'last_name',
		'date_of_birth',
		'cpf',
		'address',
		'city',
		'phone',
		'email',
		'professional_registration_number',
		'registration_entity'
	];

	public function clinic()
	{
		return $this->belongsTo(Clinic::class);
	}

	public function appointments()
	{
		return $this->hasMany(Appointment::class);
	}

	public function professional_specialties()
	{
		return $this->hasMany(ProfessionalSpecialty::class);
	}
}
