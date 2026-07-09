<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Throwable;

class CreateIdea
{
    /**
     * @throws Throwable
     */
    public function handle(array $attributes, ?User $user = null): void
    {
        $user ??= Auth::user();
        $data = collect($attributes)->only([
            'title', 'description', 'status', 'links',
        ])->toArray();

        DB::transaction(function () use ($data, $user, $attributes) {
            $idea = $user->ideas()->create($data);

            $idea->steps()->createMany(
                collect($attributes['steps'] ?? [])->map(fn ($step): array => ['description' => $step]));

        });

    }
}
