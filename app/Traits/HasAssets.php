<?php

declare(strict_types=1);

namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

trait HasAssets
{
    /**
     * Handle asset upload and return the path.
     *
     * @param UploadedFile $file
     * @param string $folder
     * @param string|null $oldPath
     * @return string
     */
    public function uploadAsset(UploadedFile $file, string $folder, ?string $oldPath = null): string
    {
        if ($oldPath) {
            $this->deleteAsset($oldPath);
        }

        return $file->store($folder, 'public');
    }

    /**
     * Delete an asset from storage.
     *
     * @param string|null $path
     * @return void
     */
    public function deleteAsset(?string $path): void
    {
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }

    /**
     * Get the full URL for an asset.
     *
     * @param string|null $path
     * @param string|null $default
     * @return string|null
     */
    public function getAssetUrl(?string $path, ?string $default = null): ?string
    {
        if ($path) {
            return asset('storage/' . $path);
        }

        return $default;
    }
}
