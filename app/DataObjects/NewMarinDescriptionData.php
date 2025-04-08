<?php

namespace Modules\RH\DataObjects;

use Spatie\LaravelData\Data;

class NewMarinDescriptionData extends Data
{
     // 'nom',
     //    'prenom',
     //    'matricule',
     //    'nid',
     //    'date_embarq',
     //    'date_debarq',
     //    'grade_id',
     //    'specialite_id',
     //    'brevet_id',
     //    'unite_id',
     //    'user_id',
     //    'data',
     //    'email',
     //    'display_name',
     //    'code_sirh_user',
    public function __construct(
        public ?string $nom,
        public ?string $prenom,
        public ?string $matricule,
        public ?string $nid,
        public ?string $date_embarq,
        public ?string $date_debarq,
        public ?string $grade_id,
        public ?string $specialite_id,
        public ?string $brevet_id,
        public ?string $unite_id,
        public ?string $user_id,
        public ?string $email,
        public ?string $display_name,
        public ?string $code_sirh_user
   ) {}

   public static function make(
      ?string $nom = null,
      ?string $prenom = null,
      ?string $matricule = null,
      ?string $nid = null,
      ?string $date_embarq = null,
      ?string $date_debarq = null,
      ?string $grade_id = null,
      ?string $specialite_id = null,
      ?string $brevet_id = null,
      ?string $unite_id = null,
      ?string $user_id = null,
      ?string $email = null,
      ?string $display_name = null,
      ?string $code_sirh_user = null
)
   {
        return new static(
           $nom,
           $prenom,
           $matricule,
           $nid,
           $date_embarq,
           $date_debarq,
           $grade_id,
           $specialite_id,
           $brevet_id,
           $unite_id,
           $user_id,
           $email,
           $display_name,
           $code_sirh_user
        );
   }
}