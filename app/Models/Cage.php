<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Factories\HasFactory;

    class Cage extends Model
    {
        use HasFactory;
        
        protected $fillable = ['sign', 'capacity'];

        public function animals()
        {
            return $this->hasMany(Animal::class);
        }
    }

?>