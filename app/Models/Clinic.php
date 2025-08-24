<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Clinic
 * 
 * @property int $id
 * @property string $name
 * @property string $cnpj
 * @property string $address
 * @property string $city
 * @property string $zip_code
 * @property string $phone
 * @property string $email
 * @property int $number_of_available_offices
 * @property int $average_consultation_duration_minutes
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Appointment[] $appointments
 * @property Collection|Patient[] $patients
 * @property Collection|Professional[] $professionals
 *
 * @package App\Models
 */
class Clinic extends Model
{
	protected $table = 'clinics';

	protected $casts = [
		'number_of_available_offices' => 'int',
		'average_consultation_duration_minutes' => 'int'
	];

	protected $fillable = [
		'name',
		'cnpj',
		'address',
		'city',
		'zip_code',
		'phone',
		'email',
		'number_of_available_offices',
		'average_consultation_duration_minutes'
	];

	public function appointments()
	{
		return $this->hasMany(Appointment::class);
	}

	public function patients()
	{
		return $this->hasMany(Patient::class);
	}

	public function professionals()
	{
		return $this->hasMany(Professional::class);
	}
}
