<?php

namespace App\Http\Livewire\Frontend;

use App\Models\Certifications;
use Livewire\Component;

class CertificationSearchComponent extends Component
{

    public $certificate_code;
    public $certificate;

    public function search()
    {
        $this->resetCertificate();

        $this->validate([
            'certificate_code' => 'required|exists:certifications,cert_code',
        ]);

        $this->certificate = Certifications::where('cert_code', $this->certificate_code)->first();
    }

    public function resetCertificate()
    {
        $this->certificate = null;
    }

    public function render()
    {
        return view('livewire.frontend.certification-search-component');
    }
}
