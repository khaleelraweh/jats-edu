<?php

namespace App\Http\Livewire\Frontend;

use App\Models\Certifications;
use Livewire\Component;
use Intervention\Image\Facades\Image;

class CertificationSearchComponent extends Component
{
    public $certificate_code;
    public $certificate;
    public $cert_image_url;

    public function search()
    {
        try {
            // Validate the input
            $validatedData = $this->validate([
                'certificate_code' => 'required|exists:certifications,cert_code',
            ]);


            // Perform the search
            $this->certificate = Certifications::where('cert_code', $this->certificate_code)->first();

            if ($this->certificate) {
                $this->cert_image_url = $this->markCopyOnCertificate($this->certificate->cert_file);
            } else {
                $this->resetCertificate();
            }
        } catch (\Illuminate\Validation\ValidationException $e) {
            throw $e;
        }
    }

    public function markCopyOnCertificate($cert_file)
    {
        // Load the image from the public directory
        $imagePath = public_path('assets/certifications/' . $cert_file);

        if (!file_exists($imagePath)) {
            return null; // Handle non-existent file
        }

        $img = Image::make($imagePath);

        // Add watermark text to the image
        $img->text('Copy to match', $img->width() / 2, $img->height() / 2, function ($font) {
            $font->file(public_path('fonts/DINNextLTArabic-Regular-3.ttf'));
            $font->size(200);
            $font->color([128, 128, 128, 0.5]); // Gray with 50% opacity
            $font->align('center');
            $font->valign('middle');
            $font->angle(45); // Tilt the text
        });

        // Save the modified image
        $newCertFile = 'marked_' . $cert_file;
        $img->save(public_path('assets/certifications/' . $newCertFile));

        // Return the URL of the new image
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
