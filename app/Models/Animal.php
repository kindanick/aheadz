<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Factories\HasFactory;

    class Animal extends Model
    {

        use HasFactory;
        
        protected $fillable = [
            'species', 
            'name', 
            'age', 
            'description', 
            'image', 
            'cage_id', 
            'created_by'
        ];

        public function cage()
        {
            return $this->belongsTo(Cage::class);
        }

        public function creator()
        {
            return $this->belongsTo(User::class, 'created_by');
        }
    }

?>