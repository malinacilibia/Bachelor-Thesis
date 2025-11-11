<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdoptionRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'post_id', 'full_name', 'email', 'phone', 'address', 'city_state', 'occupation',
        'housing_type', 'is_owner', 'rental_pet_permission', 'secure_space', 'household_allergy', 'home_presence',
        'had_pets_before', 'past_pets_details', 'has_other_pets', 'other_pets', 'adoption_reason',
        'understands_costs', 'previous_adoption', 'previous_adoption_details', 'vacation_care',
        'surrender_plan', 'covers_vet_expenses', 'willing_to_train', 'agrees_home_visits',
        'understands_commitment', 'accepts_terms', 'additional_info', 'application_status',
        'rejection_reason'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
