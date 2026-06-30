<?php

namespace App\Services;

use App\Models\Villa;
use Illuminate\Support\Collection;

class VillaRecommendationService
{
    public function recommend(Villa $villa, int $limit = 4): Collection
    {
        return Villa::query()
            ->whereKeyNot($villa->id)
            ->get()
            ->map(function (Villa $candidate) use ($villa) {
                $candidate->nilai_kemiripan = $this->cosine(
                    $villa->deskripsi,
                    $candidate->deskripsi
                );

                return $candidate;
            })
            ->sortByDesc('nilai_kemiripan')
            ->take($limit)
            ->values();
    }

    private function cosine(string $a, string $b): float
    {
        $clean = function (string $text): array {
            return array_filter(
                explode(
                    ' ',
                    strtolower(
                        preg_replace('/[^a-zA-Z0-9\s]/', '', $text)
                    )
                )
            );
        };

        $arrA = $clean($a);
        $arrB = $clean($b);

        if (empty($arrA) || empty($arrB)) {
            return 0;
        }

        $same = count(
            array_intersect(
                array_unique($arrA),
                array_unique($arrB)
            )
        );

        return $same / sqrt(count($arrA) * count($arrB));
    }
}