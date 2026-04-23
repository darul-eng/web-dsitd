<?php

declare(strict_types=1);

namespace App\Livewire\Public;

use App\Models\Gallery;
use Illuminate\Support\Collection;
use Livewire\Component;

class GalleryShowcase extends Component
{
    public int $limit = 6;

    /**
     * @return array<int, array<string, mixed>>
     */
    private function galleriesPayload(): array
    {
        /** @var Collection<int, Gallery> $galleries */
        $galleries = Gallery::query()
            ->with(['category', 'images'])
            ->withCount('images')
            ->where('is_published', true)
            ->latest()
            ->take($this->limit)
            ->get();

        return $galleries
            ->map(function (Gallery $gallery): array {
                $coverUrl = $gallery->getAssetUrl($gallery->cover_image);

                $images = $gallery->images
                    ->map(fn ($img): array => [
                        'uuid' => $img->uuid,
                        'url' => asset('storage/' . $img->image_path),
                        'caption' => $img->caption,
                    ])
                    ->values()
                    ->all();

                if (!$coverUrl && isset($images[0]['url'])) {
                    $coverUrl = $images[0]['url'];
                }

                return [
                    'uuid' => $gallery->uuid,
                    'title' => $gallery->title,
                    'date' => $gallery->created_at?->format('d M Y'),
                    'category' => $gallery->category?->name,
                    'coverUrl' => $coverUrl,
                    'imagesCount' => (int) ($gallery->images_count ?? count($images)),
                    'images' => $images,
                ];
            })
            ->values()
            ->all();
    }

    public function render()
    {
        return view('livewire.public.gallery-showcase', [
            'galleriesPayload' => $this->galleriesPayload(),
        ]);
    }
}
