<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class Patient
 *
 * @property int $id
 * @property int $clinic_id
 * @property string $first_name
 * @property string $last_name
 * @property Carbon $date_of_birth
 * @property string $cpf
 * @property string $phone
 * @property string|null $password
 * @property string $email
 * @property string $address
 * @property string $city
 * @property string $profession
 * @property string|null $insurance_card_number
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Clinic $clinic
 * @property Collection|Appointment[] $appointments
 *
 * @package App\Models
 */
class Patient extends Authenticatable
{
    protected $table = 'patients';

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
        'phone',
        'password',
        'email',
        'address',
        'city',
        'profession',
        'insurance_card_number'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function clinic()
    {
        return $this->belongsTo(Clinic::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}
