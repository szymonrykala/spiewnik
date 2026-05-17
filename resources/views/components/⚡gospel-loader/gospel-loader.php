<?php

namespace App\Livewire;

use App\Models\Performance;
use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Symfony\Component\DomCrawler\Crawler;
use Illuminate\Support\Facades\Cache;


new class extends Component
{
    public $date;

    public string $reading1;
    public string $reading2;
    public string $gospel;

    public $loading = false;
    public $error = null;

    public Performance $performance;


    public function mount(Performance $performance)
    {
        $this->performance = $performance;
        $this->date = $performance->performance_date ?? now();
        // $this->loadAllGospelReadings();
    }

    public function loadAllGospelReadings()
    {
        $this->loading = true;
        $this->error = null;

        $cacheKey = 'liturgia_' . $this->date;

        try {
            $data = Cache::remember($cacheKey, now()->addHours(24), function () {
                $url = "https://niezbednik.niedziela.pl/liturgia/{$this->date->format('Y-m-d')}";

                $response = Http::withUserAgent('Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36')
                    ->timeout(15)
                    ->get($url);

                if (!$response->successful()) {
                    $this->error = $response->status() . ' - ' . $response->body();
                    $this->loading = false;
                    return;
                }

                $crawler = new Crawler($response->body());

                return [
                    "reading1" => $this->loadFromTab($crawler, 'tabnowy00'),
                    "reading2" => $this->loadFromTab($crawler, 'tabnowy02'),
                    "gospel" => $this->loadFromTab($crawler, 'tabnowy04')
                ];
            });

            $this->reading1 = $data["reading1"];
            $this->reading2 = $data["reading2"];
            $this->gospel = $data["gospel"];
        } catch (\Exception $e) {
            $this->error = $e->getMessage();
        }

        $this->loading = false;
    }

    private function loadFromTab(Crawler $crawler, string $tabId)
    {
        $tab = $crawler->filter("#{$tabId}");

        if ($tab->count() === 0) {
            return ['title' => '', 'ref' => '', 'content' => ''];
        }

        return trim($tab->html());
    }
};
