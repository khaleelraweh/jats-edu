<?php

namespace App\Http\Livewire\Frontend;

use App\Models\Certifications;
use Livewire\Component;

class CertificationSearchComponent extends Component
{

    public $certificate_id;
    public $certificate;

    public function search()
    {
        $this->validate([
            'certificate_id' => 'required|exists:certifications,id',
        ]);

        $this->certificate = Certifications::find($this->certificate_id);
    }

    public function render()
    {
        return view('livewire.frontend.certification-search-component');
    }
}
