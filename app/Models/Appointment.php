<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Appointment
 * 
 * @property int $id
 * @property int $clinic_id
 * @property int $patient_id
 * @property int $professional_id
 * @property Carbon $start_time
 * @property Carbon $end_time
 * @property string $status
 * @property int $duration_minutes
 * @property string|null $notes
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Clinic $clinic
 * @property Patient $patient
 * @property Professional $professional
 *
 * @package App\Models
 */
class Appointment extends Model
{
	use HasFactory;

	protected $table = 'appointments';

	protected $casts = [
		'clinic_id' => 'int',
		'patient_id' => 'int',
		'professional_id' => 'int',
		'start_time' => 'datetime',
		'end_time' => 'datetime',
		'duration_minutes' => 'int'
	];

	protected $fillable = [
		'clinic_id',
		'patient_id',
		'professional_id',
		'start_time',
		'end_time',
		'status',
		'duration_minutes',
		'notes'
	];

	public function clinic()
	{
		return $this->belongsTo(Clinic::class);
	}

	public function patient()
	{
		return $this->belongsTo(Patient::class);
	}

	public function professional()
	{
		return $this->belongsTo(Professional::class);
	}
}
