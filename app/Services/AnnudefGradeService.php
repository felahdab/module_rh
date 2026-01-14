<?php
namespace  Modules\RH\Services;

use Modules\RH\Models\Grade;

class AnnudefGradeService
{
    public static function getGradeFromAnnudefRank(string $annudef_rank) : ?Grade
    {
        $return_value = match ($annudef_rank) {
            "Matelot" => "9d74f78a-67d7-4899-8ad2-cd321cc04427",
            "Matelot de 1ère classe" => "9d74f78a-6518-465c-bf62-6c9d413a8d2f",
            "Quartier-maître de 2ème classe" => "9d74f78a-623a-4aaf-bdbb-1f07cbc8914f",
            "Quartier-maître de 1ère classe" => "9d74f78a-5f15-468e-8741-effb304bc27e",
            "Second maître" => "9d74f78a-5912-4ce7-92f5-7d812ce75fa6",
            "Maître" => "9d74f78a-570d-4847-a267-7854e0f92446", 
            "Premier maître" => "9d74f78a-558a-4117-be2c-91a9b5a28226",
            "Maître principal" => "9d74f78a-53eb-483e-9b2d-eba63724aeb2",
            "Major" => "9d74f78a-51f7-42ec-ad52-db956d075a82",
            "Aspirant" => "9d74f78a-4ffb-4c62-863a-4dc9638ec3fd",
            "Enseigne de vaisseau de 2ème classe" => "9d74f78a-4e79-452f-b877-886f914f489c",
            "Enseigne de vaisseau de 1ère classe" => "9d74f78a-4d0b-4c74-9eb8-49b6c7d61755",
            "Lieutenant de vaisseau" => "9d74f78a-4bc1-4581-88b6-0f92e26cc8db",
            "Capitaine de corvette" => "9d74f78a-4a77-4532-b4fa-bfe687c74fec",
            "Capitaine de frégate" => "9d74f78a-4928-4e6c-b696-41a939cab841",
            "Capitaine de vaisseau" => "9d74f78a-47da-40c6-b8c1-0312a97e68b3",
            "Contre-amiral" => "9d74f78a-4697-4f61-b83b-a1c378c2f451",
            "Vice-amiral" => "9d74f78a-4542-48cb-b447-1221067aaa6c",
            "Vice-amiral d'escadre" => "9d74f78a-43f6-4bc0-b212-9aae64dd2224",
            "Amiral" => "9d74f78a-4146-4d29-8654-fa3fc198f2e4",
            default => null,
        };

        $grade = Grade::where("uuid", $return_value)->first();

        return $grade;
    }
}