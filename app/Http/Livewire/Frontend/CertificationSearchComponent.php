<?php

namespace App\Http\Livewire\Frontend;

use App\Models\Certifications;
use Livewire\Component;
use Intervention\Image\Facades\Image; // <-- Add this line

class CertificationSearchComponent extends Component
{
    public $certificate_code;
    public $certificate;
    public $cert_image_url;

    public function search()
    {
        $this->resetCertificate();

        $this->validate([
            'certificate_code' => 'required|exists:certifications,cert_code',
        ]);

        $this->certificate = Certifications::where('cert_code', $this->certificate_code)->first();

        if ($this->certificate) {
            $this->cert_image_url = $this->markCopyOnCertificate($this->certificate->cert_file);
        } else {
            $this->resetCertificate();
        }
    }

    // public function markCopyOnCertificate($cert_file)
    // {
    //     // Load the image from the public directory
    //     $imagePath = public_path('assets/certifications/' . $cert_file);

    //     if (!file_exists($imagePath)) {
    //         // Handle the case where the image doesn't exist
    //         return null;  // or throw an exception
    //     }

    //     $img = Image::make($imagePath);

    //     // Add text (e.g., "One Hundred") to the image
    //     $img->text('Copy to match', $img->width() / 2, $img->height() / 2, function ($font) {
    //         $font->file(public_path('fonts/DINNextLTArabic-Regular-3.ttf')); // Replace with your font file if needed
    //         $font->size(100);
    //         $font->color('#FF0000');
    //         $font->align('center');
    //         $font->valign('middle');
    //         $font->angle(45); // Optional: add a tilt to the text
    //     });

    //     // Save the image to a temporary file or overwrite the original
    //     $newCertFile = 'marked_' . $cert_file;
    //     $img->save(public_path('assets/certifications/' . $newCertFile));

    //     // Return the new image URL
    //     return asset('assets/certifications/' . $newCertFile);
    // }

    public function markCopyOnCertificate($cert_file)
    {
        // Load the image from the public directory
        $imagePath = public_path('assets/certifications/' . $cert_file);

        if (!file_exists($imagePath)) {
            // Handle the case where the image doesn't exist
            return null;  // or throw an exception
        }

        $img = Image::make($imagePath);

        // Add background text (e.g., "Copy to match") to the image
        $img->text('Copy to match', $img->width() / 2, $img->height() / 2, function ($font) {
            $font->file(public_path('fonts/DINNextLTArabic-Regular-3.ttf')); // Use your specific font file
            $font->size(100);
            $font->color([128, 128, 128, 0.5]); // Gray color with 50% opacity
            $font->align('center');
            $font->valign('middle');
            $font->angle(45); // Tilt the text for watermark effect
        });

        // Save the image to a temporary file or overwrite the original
        $newCertFile = 'marked_' . $cert_file;
        $img->save(public_path('assets/certifications/' . $newCertFile));

        // Return the new image URL
        return asset('assets/certifications/' . $newCertFile);
    }



    public function resetCertificate()
    {
        $this->certificate = null;
        $this->cert_image_url = null;
    }

    public function render()
    {
        return view('livewire.frontend.certification-search-component');
    }
}
