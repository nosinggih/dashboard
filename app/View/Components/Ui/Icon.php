<?php

namespace App\View\Components\Ui;

use Illuminate\Support\Facades\File;
use Illuminate\View\Component;
use Illuminate\View\View;

class Icon extends Component
{
    public string $viewBox;

    public string $paths;

    public function __construct(
        public string $name,
        public int $size = 20,
    ) {
        [$this->viewBox, $this->paths] = $this->parse($name);
    }

    public function render(): View
    {
        return view('components.ui.icon');
    }

    /**
     * @return array{0: string, 1: string}
     */
    private function parse(string $name): array
    {
        $path = resource_path("svg/icons/{$name}.svg");

        if (! File::exists($path)) {
            return ['0 0 24 24', ''];
        }

        $raw = File::get($path);

        preg_match('/viewBox="([^"]+)"/', $raw, $viewBoxMatch);
        preg_match('/<svg\b[^>]*>(.*)<\/svg>/is', $raw, $bodyMatch);

        return [
            $viewBoxMatch[1] ?? '0 0 24 24',
            trim($bodyMatch[1] ?? ''),
        ];
    }
}
