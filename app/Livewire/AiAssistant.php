<?php

namespace App\Livewire;

use Livewire\Component;

class AiAssistant extends Component
{
    public $isOpen = false;
    public $messages = [];
    public $currentMessage = '';
    public $isTyping = false;

    public function mount()
    {
        $this->messages = [
            [
                'type' => 'bot',
                'message' => 'Cześć! 👋 Jestem asystentem Custom Labels. Jak mogę Ci pomóc?',
                'time' => now()->format('H:i')
            ]
        ];
    }

    public function toggleChat()
    {
        $this->isOpen = !$this->isOpen;
    }

    public function sendMessage()
    {
        if (empty(trim($this->currentMessage))) {
            return;
        }

        // Dodaj wiadomość użytkownika
        $this->messages[] = [
            'type' => 'user',
            'message' => $this->currentMessage,
            'time' => now()->format('H:i')
        ];

        $userMessage = $this->currentMessage;
        $this->currentMessage = '';
        $this->isTyping = true;

        // DEBUG: Sprawdź czy wiadomość się wysyła
        file_put_contents('debug.log', "User message: " . $userMessage . "\n", FILE_APPEND);

        // Symuluj opóźnienie odpowiedzi
        $this->dispatch('scroll-to-bottom');
        
        // Generuj odpowiedź bota
        $botResponse = $this->generateBotResponse($userMessage);
        
        // Dodaj odpowiedź bota po opóźnieniu
        $this->messages[] = [
            'type' => 'bot',
            'message' => $botResponse['message'],
            'time' => now()->format('H:i'),
            'actions' => $botResponse['actions'] ?? []
        ];

        $this->isTyping = false;
        $this->dispatch('scroll-to-bottom');
    }

    private function generateBotResponse($message)
    {
        $originalMessage = trim($message);
        $message = strtolower($originalMessage);
        
        // DEBUG: Sprawdź czy funkcja się wykonuje
        error_log("AI Assistant: Generating response for: " . $originalMessage);
        
        // TURBO INTELIGENTNY AI - próbuj darmowe API najpierw
        
        // 1. Groq - NAJSZYBSZE i DARMOWE (Llama 3)
        if (env('GROQ_API_KEY')) {
            $aiResponse = $this->getGroqResponse($originalMessage);
            if ($aiResponse) {
                return $aiResponse;
            }
        }
        
        // 2. Hugging Face - DARMOWE
        if (env('HUGGINGFACE_API_KEY')) {
            $aiResponse = $this->getHuggingFaceResponse($originalMessage);
            if ($aiResponse) {
                return $aiResponse;
            }
        }
        
        // 3. OpenAI - PŁATNE ale najlepsze
        if (env('OPENAI_API_KEY')) {
            $aiResponse = $this->getOpenAIResponse($originalMessage);
            if ($aiResponse) {
                return $aiResponse;
            }
        }
        
        // Analiza sentymentu i intencji
        $sentiment = $this->analyzeSentiment($message);
        $intent = $this->analyzeIntent($message);
        
        // Reakcje na negatywne/odrzucające odpowiedzi
        if ($sentiment === 'negative' || $this->isRejection($message)) {
            return $this->handleRejection($message);
        }
        
        // Reakcje na pozytywne odpowiedzi
        if ($sentiment === 'positive' || $this->isAgreement($message)) {
            return $this->handleAgreement($message);
        }
        
        // Bardzo krótkie pytania/słowa
        if (strlen($message) <= 3) {
            $shortResponses = [
                'co' => 'Co Cię interesuje? Mogę pomóc z etykietami, cenami, ustawieniami lub odpowiedzieć na pytania! 🤔',
                'jak' => 'Jak mogę pomóc? Chcesz stworzyć etykietę, sprawdzić ceny, czy może masz inne pytanie? 🛠️',
                'ile' => 'Pytasz o ceny? Nasze etykiety zaczynają się już od kilku złotych! Sprawdź pełny cennik 💰',
                'co?' => 'Co Cię interesuje? Mogę pomóc z etykietami, cenami, ustawieniami lub odpowiedzieć na pytania! 🤔',
                'hej' => 'Hej! 👋 Miło Cię widzieć! W czym mogę pomóc?',
                'cześć' => 'Cześć! 😊 Jak mogę Ci dzisiaj pomóc?',
                'hi' => 'Hi! 👋 How can I help you today?',
                'ok' => 'Super! Jeśli masz jakieś pytania, śmiało pytaj! 😊',
                'no' => 'Okej, jeśli zmienisz zdanie lub będziesz miał pytania - jestem tutaj! 👍'
            ];
            
            if (isset($shortResponses[$message])) {
                return [
                    'message' => $shortResponses[$message],
                    'actions' => [
                        ['text' => '🚀 Kreator', 'url' => '/creator'],
                        ['text' => '💰 Cennik', 'action' => 'scroll-to-pricing'],
                        ['text' => '❓ FAQ', 'action' => 'scroll-to-faq']
                    ]
                ];
            }
        }

        // Pytania o konkretne rzeczy
        if (str_contains($message, 'co to') || str_contains($message, 'czym jest') || str_contains($message, 'co oznacza')) {
            return [
                'message' => 'Custom Labels to platforma do tworzenia spersonalizowanych etykiet! Możesz projektować etykiety na produkty, opakowania, butelki i wiele więcej. Mamy kreator online, różne materiały i szybką realizację! 🏷️',
                'actions' => [
                    ['text' => '🎨 Zobacz Kreator', 'url' => '/creator'],
                    ['text' => '📋 Gotowe Wzory', 'action' => 'scroll-to-configs']
                ]
            ];
        }

        // Pytania o czas/dostawę
        if (str_contains($message, 'ile czasu') || str_contains($message, 'jak długo') || str_contains($message, 'dostawa') || str_contains($message, 'wysyłka')) {
            return [
                'message' => 'Standardowa realizacja to 3-5 dni roboczych + czas dostawy. Oferujemy też opcję ekspresową (24h) za dopłatą. Wysyłamy kurierem lub Pocztą Polską! 📦⚡',
                'actions' => [
                    ['text' => '💰 Zobacz Ceny', 'action' => 'scroll-to-pricing'],
                    ['text' => '🚀 Zamów Teraz', 'url' => '/creator']
                ]
            ];
        }

        // Pytania o jakość/materiały
        if (str_contains($message, 'jakość') || str_contains($message, 'materiał') || str_contains($message, 'papier') || str_contains($message, 'folia') || str_contains($message, 'laminat') || str_contains($message, 'wodoodporn')) {
            return [
                'message' => 'Używamy wysokiej jakości materiałów! Mamy papier kraft, białą folię, laminaty matowe i błyszczące. Wszystkie są wodoodporne i trwałe. Druk w rozdzielczości 1200 DPI! 📋✨',
                'actions' => [
                    ['text' => '🎨 Sprawdź w Kreatorze', 'url' => '/creator'],
                    ['text' => '📋 Zobacz Wzory', 'action' => 'scroll-to-configs']
                ]
            ];
        }

        // Kreator etykiet
        if (str_contains($message, 'kreator') || str_contains($message, 'etykiet') || str_contains($message, 'projekt') || str_contains($message, 'design') || str_contains($message, 'stworz')) {
            return [
                'message' => 'Nasz kreator to potężne narzędzie! Wybierasz kształt, rozmiar, materiał, dodajesz tekst, logo, obrazy. Masz podgląd na żywo i możesz wszystko personalizować! 🎨✨',
                'actions' => [
                    ['text' => '🚀 Otwórz Kreator', 'url' => '/creator'],
                    ['text' => '📋 Gotowe Wzory', 'action' => 'scroll-to-configs']
                ]
            ];
        }

        // Cennik/ceny
        if (str_contains($message, 'cen') || str_contains($message, 'koszt') || str_contains($message, 'ile kosztuje') || str_contains($message, 'płat') || str_contains($message, 'drogo') || str_contains($message, 'tanio')) {
            return [
                'message' => 'Nasze ceny są bardzo konkurencyjne! Zaczynamy od 2,50 zł za etykietę. Im więcej zamawiasz, tym taniej! Mamy też pakiety biznesowe z rabatem do 40%! 💰🔥',
                'actions' => [
                    ['text' => '💰 Pełny Cennik', 'action' => 'scroll-to-pricing'],
                    ['text' => '🎁 Kod Rabatowy', 'action' => 'show-discount']
                ]
            ];
        }

        // Ustawienia/profil/konto
        if (str_contains($message, 'ustawien') || str_contains($message, 'profil') || str_contains($message, 'kont') || str_contains($message, 'hasł') || str_contains($message, 'dane')) {
            return [
                'message' => 'W ustawieniach możesz zmienić swoje dane, hasło, dodać zdjęcie profilowe, sprawdzić historię zamówień i zarządzać preferencjami! 👤⚙️',
                'actions' => [
                    ['text' => '⚙️ Otwórz Ustawienia', 'url' => '/settings/profile'],
                    ['text' => '📊 Historia Zamówień', 'url' => '/settings/profile']
                ]
            ];
        }

        // Newsletter/promocje
        if (str_contains($message, 'newsletter') || str_contains($message, 'subskryb') || str_contains($message, 'nowości') || str_contains($message, 'promocj') || str_contains($message, 'rabat') || str_contains($message, 'zniżk')) {
            return [
                'message' => 'Zapisz się do newslettera i otrzymuj ekskluzywne promocje, kody rabatowe i informacje o nowościach! Pierwszy kod: WELCOME20 (-20%)! 📧🎁',
                'actions' => [
                    ['text' => '📧 Zapisz się', 'action' => 'scroll-to-newsletter'],
                    ['text' => '🎁 Odbierz Kod', 'action' => 'show-discount']
                ]
            ];
        }

        // Pomoc/FAQ/problemy
        if (str_contains($message, 'pomoc') || str_contains($message, 'problem') || str_contains($message, 'błąd') || str_contains($message, 'nie działa') || str_contains($message, 'nie mogę')) {
            return [
                'message' => 'Masz problem? Sprawdź nasze FAQ - znajdziesz tam odpowiedzi na najczęstsze pytania. Jeśli to nie pomoże, napisz do nas! Odpowiadamy w 24h! 🆘💬',
                'actions' => [
                    ['text' => '❓ Sprawdź FAQ', 'action' => 'scroll-to-faq'],
                    ['text' => '📧 Napisz do Nas', 'url' => '#']
                ]
            ];
        }

        // Pytania o firmę/kontakt
        if (str_contains($message, 'kim jesteś') || str_contains($message, 'o firmie') || str_contains($message, 'kontakt') || str_contains($message, 'adres') || str_contains($message, 'telefon')) {
            return [
                'message' => 'Jesteśmy Custom Labels - polską firmą specjalizującą się w etykietach! Działamy od 2020 roku, mamy tysiące zadowolonych klientów. Kontakt: CustomLabelHelp@gmail.com 🏢📞',
                'actions' => [
                    ['text' => '📞 Kontakt', 'url' => '#'],
                    ['text' => '🏆 Nasze Realizacje', 'action' => 'scroll-to-configs']
                ]
            ];
        }

        // Pozdrowienia/pożegnania
        if (str_contains($message, 'dzięki') || str_contains($message, 'dziękuję') || str_contains($message, 'thx') || str_contains($message, 'thanks')) {
            return [
                'message' => 'Nie ma za co! Cieszę się, że mogłem pomóc! Jeśli będziesz miał więcej pytań, śmiało pisz! 😊👍',
                'actions' => []
            ];
        }

        if (str_contains($message, 'pa') || str_contains($message, 'żegn') || str_contains($message, 'bye') || str_contains($message, 'do widzenia')) {
            return [
                'message' => 'Do widzenia! Miło było z Tobą rozmawiać! Wracaj, gdy będziesz potrzebować pomocy z etykietami! 👋😊',
                'actions' => []
            ];
        }

        // Niezrozumiałe/bardzo krótkie
        if (strlen($message) < 5 && !isset($shortResponses[$message])) {
            return [
                'message' => 'Hmm, nie jestem pewien co masz na myśli 🤔 Możesz sprecyzować pytanie? Mogę pomóc z etykietami, cenami, kreowaniem czy ustawieniami!',
                'actions' => [
                    ['text' => '🚀 Kreator', 'url' => '/creator'],
                    ['text' => '💰 Cennik', 'action' => 'scroll-to-pricing'],
                    ['text' => '❓ FAQ', 'action' => 'scroll-to-faq']
                ]
            ];
        }

        // Reakcje na emocjonalne wypowiedzi
        if ($this->isEmotional($message)) {
            return $this->handleEmotional($message);
        }
        
        // Reakcje na żarty/śmiech
        if ($this->isJoke($message)) {
            return $this->handleJoke($message);
        }
        
        // Reakcje na przekleństwa/frustrację
        if ($this->isFrustrated($message)) {
            return $this->handleFrustration($message);
        }
        
        // Reakcje na komplementy
        if ($this->isCompliment($message)) {
            return $this->handleCompliment($message);
        }
        
        // Inteligentna analiza kontekstu
        $contextResponse = $this->analyzeContext($message);
        if ($contextResponse) {
            return $contextResponse;
        }

        // Próba inteligentnego dopasowania na podstawie długości i struktury
        if (strlen($message) > 20) {
            // Długie wiadomości - próba wyciągnięcia kluczowych słów
            $keyWords = $this->extractKeywords($message);
            if (!empty($keyWords)) {
                return [
                    'message' => "Widzę, że piszesz o: " . implode(', ', $keyWords) . ". 🎯 To brzmi interesująco! Czy mogę pomóc Ci z czymś konkretnym związanym z etykietami? Jestem ekspertem i chętnie doradzę!",
                    'actions' => [
                        ['text' => '🚀 Kreator Etykiet', 'url' => '/creator'],
                        ['text' => '💰 Sprawdź Ceny', 'action' => 'scroll-to-pricing'],
                        ['text' => '❓ Zadaj Konkretne Pytanie', 'action' => 'scroll-to-faq']
                    ]
                ];
            }
        }

        // Domyślna odpowiedź dla dłuższych, ale niezrozumiałych wiadomości
        $smartDefaults = [
            'Hmm, próbuję zrozumieć o co Ci chodzi! 🤔 Czy możesz mi pomóc i powiedzieć czy chodzi o etykiety, ceny, projektowanie, czy coś zupełnie innego?',
            'Interesujące! 💭 Widzę, że masz coś na myśli, ale nie jestem pewien co dokładnie. Możesz sprecyzować? Jestem ekspertem od etykiet i chętnie pomogę!',
            'Brzmi jak coś ważnego! 🎯 Żeby lepiej Ci pomóc, powiedz mi - czy pytasz o nasze usługi, masz problem, czy może potrzebujesz konkretnej informacji?',
            'Staram się zrozumieć Twoją wiadomość! 🧠 Może powiesz mi więcej szczegółów? Im więcej wiem, tym lepiej mogę pomóc z etykietami!'
        ];

        return [
            'message' => $smartDefaults[array_rand($smartDefaults)],
            'actions' => [
                ['text' => '🚀 Kreator Etykiet', 'url' => '/creator'],
                ['text' => '💰 Sprawdź Ceny', 'action' => 'scroll-to-pricing'],
                ['text' => '❓ FAQ', 'action' => 'scroll-to-faq'],
                ['text' => '⚙️ Ustawienia', 'url' => '/settings/profile']
            ]
        ];
    }

    private function analyzeSentiment($message)
    {
        // Słowa negatywne
        $negativeWords = ['nie', 'nie chcę', 'nie potrzebuję', 'nie interesuje', 'nie dziękuję', 'nie trzeba', 'zostaw', 'odejdź', 'spadaj', 'nie ma mowy', 'nigdy', 'żadnej', 'wcale', 'bzdura', 'głupie', 'bez sensu', 'nudne', 'słabe'];
        
        // Słowa pozytywne
        $positiveWords = ['tak', 'super', 'świetnie', 'doskonale', 'chcę', 'potrzebuję', 'interesuje', 'podoba', 'fajnie', 'cool', 'wow', 'genialnie', 'idealnie', 'perfekt', 'lubię', 'kocham'];
        
        foreach ($negativeWords as $word) {
            if (str_contains($message, $word)) {
                return 'negative';
            }
        }
        
        foreach ($positiveWords as $word) {
            if (str_contains($message, $word)) {
                return 'positive';
            }
        }
        
        return 'neutral';
    }

    private function analyzeIntent($message)
    {
        // Analiza intencji użytkownika
        if (str_contains($message, '?') || str_contains($message, 'jak') || str_contains($message, 'co') || str_contains($message, 'gdzie') || str_contains($message, 'kiedy') || str_contains($message, 'dlaczego')) {
            return 'question';
        }
        
        if (str_contains($message, 'chcę') || str_contains($message, 'potrzebuję') || str_contains($message, 'zamówić') || str_contains($message, 'kupić')) {
            return 'request';
        }
        
        if (str_contains($message, 'problem') || str_contains($message, 'błąd') || str_contains($message, 'nie działa') || str_contains($message, 'pomoc')) {
            return 'help';
        }
        
        return 'statement';
    }

    private function isRejection($message)
    {
        $rejectionPhrases = [
            'nie chcę pomocy', 'nie potrzebuję pomocy', 'nie interesuje mnie', 'nie dziękuję', 
            'zostaw mnie', 'nie trzeba', 'nie ma mowy', 'nie chcę', 'nie potrzebuję',
            'odejdź', 'spadaj', 'nie', 'nope', 'nie ma opcji', 'bez sensu'
        ];
        
        foreach ($rejectionPhrases as $phrase) {
            if (str_contains($message, $phrase)) {
                return true;
            }
        }
        
        return false;
    }

    private function isAgreement($message)
    {
        $agreementPhrases = [
            'tak', 'oczywiście', 'jasne', 'pewnie', 'zgoda', 'ok', 'okay', 'dobrze',
            'super', 'świetnie', 'chcę', 'potrzebuję', 'interesuje mnie', 'tak, chcę'
        ];
        
        foreach ($agreementPhrases as $phrase) {
            if (str_contains($message, $phrase)) {
                return true;
            }
        }
        
        return false;
    }

    private function handleRejection($message)
    {
        $rejectionResponses = [
            'Rozumiem! Nie ma problemu 😊 Jeśli zmienisz zdanie, jestem tutaj. Może chcesz po prostu przeglądać stronę?',
            'W porządku! Nie będę Cię więcej niepokoić. Gdybyś jednak miał jakieś pytania o etykiety - jestem do dyspozycji! 👍',
            'Okej, szanuję Twoją decyzję! Zostanę tutaj na dole, gdybyś jednak potrzebował pomocy z czymkolwiek 🤐',
            'Spoko! Każdy ma prawo do spokoju. Jeśli kiedyś będziesz potrzebować etykiet - wiesz gdzie mnie znaleźć! 😌'
        ];
        
        return [
            'message' => $rejectionResponses[array_rand($rejectionResponses)],
            'actions' => []
        ];
    }

    private function handleAgreement($message)
    {
        $agreementResponses = [
            'Świetnie! 🎉 W czym mogę Ci pomóc? Chcesz stworzyć etykietę, sprawdzić ceny, czy może masz konkretne pytanie?',
            'Super! 😊 Cieszę się, że mogę pomóc! Co Cię najbardziej interesuje - projektowanie, materiały, ceny?',
            'Doskonale! 🚀 Jestem gotowy do działania! Powiedz mi, czego potrzebujesz - etykiety, informacje, czy pomoc z czymś konkretnym?',
            'Fantastycznie! 💪 Razem stworzymy coś wspaniałego! Od czego zaczynamy - kreator, cennik, czy może masz pytania?'
        ];
        
        return [
            'message' => $agreementResponses[array_rand($agreementResponses)],
            'actions' => [
                ['text' => '🚀 Kreator Etykiet', 'url' => '/creator'],
                ['text' => '💰 Zobacz Ceny', 'action' => 'scroll-to-pricing'],
                ['text' => '📋 Gotowe Wzory', 'action' => 'scroll-to-configs'],
                ['text' => '❓ Mam Pytanie', 'action' => 'scroll-to-faq']
            ]
        ];
    }

    private function isEmotional($message)
    {
        $emotionalWords = ['kocham', 'nienawidzę', 'uwielbiam', 'nie znoszę', 'jestem zły', 'jestem smutny', 'jestem szczęśliwy', 'frustruje mnie', 'denerwuje mnie', 'cieszę się', 'martwię się'];
        
        foreach ($emotionalWords as $word) {
            if (str_contains($message, $word)) {
                return true;
            }
        }
        
        return false;
    }

    private function handleEmotional($message)
    {
        if (str_contains($message, 'kocham') || str_contains($message, 'uwielbiam') || str_contains($message, 'szczęśliwy') || str_contains($message, 'cieszę się')) {
            return [
                'message' => 'Cieszę się, że masz pozytywne nastawienie! 😊 To świetnie wpływa na kreatywność przy projektowaniu etykiet! Może stworzymy coś wspaniałego razem?',
                'actions' => [
                    ['text' => '🎨 Twórzmy!', 'url' => '/creator'],
                    ['text' => '✨ Inspiracje', 'action' => 'scroll-to-configs']
                ]
            ];
        }
        
        if (str_contains($message, 'nienawidzę') || str_contains($message, 'nie znoszę') || str_contains($message, 'zły') || str_contains($message, 'frustruje') || str_contains($message, 'denerwuje')) {
            return [
                'message' => 'Rozumiem, że coś Cię frustruje 😔 Może mogę pomóc rozwiązać problem? Czasem świeże spojrzenie na etykiety może poprawić humor!',
                'actions' => [
                    ['text' => '🆘 Pomoc', 'action' => 'scroll-to-faq'],
                    ['text' => '😌 Relaks z Kreowaniem', 'url' => '/creator']
                ]
            ];
        }
        
        return [
            'message' => 'Widzę, że masz silne emocje związane z tym tematem! 💭 Jak mogę Ci pomóc? Może etykiety pomogą wyrazić to, co czujesz?',
            'actions' => [
                ['text' => '🎨 Wyrażaj Siebie', 'url' => '/creator'],
                ['text' => '💬 Porozmawiajmy', 'action' => 'scroll-to-faq']
            ]
        ];
    }

    private function isJoke($message)
    {
        $jokeIndicators = ['haha', 'hehe', 'lol', 'xd', 'żart', 'śmieszne', '😂', '😄', '😆', 'hahaha', 'hihi', 'żartuje', 'tylko żart'];
        
        foreach ($jokeIndicators as $indicator) {
            if (str_contains($message, $indicator)) {
                return true;
            }
        }
        
        return false;
    }

    private function handleJoke($message)
    {
        $jokeResponses = [
            'Haha, lubię poczucie humoru! 😄 Wiesz co też jest śmieszne? Jak łatwo można stworzyć profesjonalne etykiety w naszym kreatorze!',
            'Śmiech to zdrowie! 😂 A wiesz co jeszcze jest zdrowe? Dobrze zaprojektowane etykiety na produktach! Chcesz spróbować?',
            'LOL! 🤣 Widzę, że masz dobry humor! Może wykorzystamy tę pozytywną energię do stworzenia czegoś kreatywnego?',
            'Hehe, fajnie się z Tobą rozmawia! 😊 Może teraz czas na coś produktywnego - jak myślisz o projektowaniu etykiet?'
        ];
        
        return [
            'message' => $jokeResponses[array_rand($jokeResponses)],
            'actions' => [
                ['text' => '🎨 Kreatywnie!', 'url' => '/creator'],
                ['text' => '😄 Więcej Zabawy', 'action' => 'scroll-to-configs']
            ]
        ];
    }

    private function isFrustrated($message)
    {
        $frustrationWords = ['kurwa', 'cholera', 'do diabła', 'do jasnej', 'pieprzyć', 'gówno', 'szlag', 'kurcze', 'do licha', 'nie działa', 'nie mogę', 'mam dość', 'wkurza mnie'];
        
        foreach ($frustrationWords as $word) {
            if (str_contains($message, $word)) {
                return true;
            }
        }
        
        return false;
    }

    private function handleFrustration($message)
    {
        $frustrationResponses = [
            'Widzę, że jesteś sfrustrowany 😅 Spokojnie! Może pomogę rozładować napięcie? Projektowanie etykiet może być bardzo relaksujące!',
            'Hej, hej! 🤗 Wiem, że czasem wszystko wkurza, ale może znajdziemy sposób żeby poprawić Ci humor? Kreatywność pomaga!',
            'Rozumiem frustrację! 😤 Ale wiesz co? Czasem najlepsze projekty powstają właśnie wtedy, gdy jesteśmy zdenerwowani - więcej energii!',
            'Okej, widzę że masz ciężki dzień 😔 Może zrobimy sobie przerwę od problemów i stworzymy coś fajnego? To może pomóc!'
        ];
        
        return [
            'message' => $frustrationResponses[array_rand($frustrationResponses)],
            'actions' => [
                ['text' => '😌 Uspokój się', 'url' => '/creator'],
                ['text' => '💪 Kanalizuj Energię', 'action' => 'scroll-to-configs'],
                ['text' => '🆘 Potrzebuję Pomocy', 'action' => 'scroll-to-faq']
            ]
        ];
    }

    private function isCompliment($message)
    {
        $compliments = ['świetny', 'genialny', 'super', 'fantastyczny', 'doskonały', 'wspaniały', 'niesamowity', 'rewelacyjny', 'perfect', 'amazing', 'great', 'awesome', 'fajny asystent', 'dobry bot', 'pomocny'];
        
        foreach ($compliments as $compliment) {
            if (str_contains($message, $compliment)) {
                return true;
            }
        }
        
        return false;
    }

    private function handleCompliment($message)
    {
        $complimentResponses = [
            'Aww, dziękuję! 😊 To bardzo miłe! Cieszę się, że mogę pomóc! Teraz może wykorzystajmy tę pozytywną energię do stworzenia czegoś wspaniałego?',
            'Uśmiechnąłeś mnie! 😄 Dzięki za komplement! Wiesz co też jest świetne? Nasze etykiety! Chcesz zobaczyć?',
            'Bardzo dziękuję! 🥰 Takie słowa motywują mnie do jeszcze lepszej pomocy! W czym mogę Ci teraz pomóc?',
            'Och, rumienię się! 😳 Dzięki! Teraz jestem jeszcze bardziej zmotywowany żeby pomóc Ci stworzyć coś niesamowitego!'
        ];
        
        return [
            'message' => $complimentResponses[array_rand($complimentResponses)],
            'actions' => [
                ['text' => '🎨 Twórzmy Razem!', 'url' => '/creator'],
                ['text' => '✨ Pokaż Możliwości', 'action' => 'scroll-to-configs'],
                ['text' => '💰 Zobacz Ofertę', 'action' => 'scroll-to-pricing']
            ]
        ];
    }

    private function analyzeContext($message)
    {
        // Zaawansowana analiza kontekstu - próba zrozumienia intencji jak prawdziwy AI
        
        // Pytania o możliwości/funkcje
        if (preg_match('/co potrafisz|co umiesz|jakie funkcje|co możesz|na co się przydajesz/', $message)) {
            return [
                'message' => 'Mogę Ci pomóc w wielu rzeczach! 🤖 Znam się na etykietach od A do Z - materiały, rozmiary, ceny, realizacja. Mogę doradzić w projektowaniu, pokazać opcje, wytłumaczyć proces zamówienia. Jestem tutaj żeby ułatwić Ci życie z etykietami! Co konkretnie Cię interesuje?',
                'actions' => [
                    ['text' => '🎨 Projektowanie', 'url' => '/creator'],
                    ['text' => '💰 Ceny i Opcje', 'action' => 'scroll-to-pricing'],
                    ['text' => '📋 Materiały', 'action' => 'scroll-to-configs'],
                    ['text' => '❓ Proces Zamówienia', 'action' => 'scroll-to-faq']
                ]
            ];
        }
        
        // Pytania o różnice/porównania
        if (preg_match('/różnica|porównanie|lepszy|gorszy|vs|versus|czy lepiej/', $message)) {
            return [
                'message' => 'Świetne pytanie o porównania! 🤔 Każdy materiał ma swoje zalety: papier kraft to eko i elegancja, biała folia to trwałość i wodoodporność, laminaty to premium i ochrona. Rozmiar zależy od zastosowania, a ilość od budżetu. Powiedz mi do czego potrzebujesz etykiety, a doradzę najlepszą opcję!',
                'actions' => [
                    ['text' => '📋 Porównaj Materiały', 'action' => 'scroll-to-configs'],
                    ['text' => '🎯 Dobierz dla Mnie', 'url' => '/creator']
                ]
            ];
        }
        
        // Pytania o proces/jak to działa
        if (preg_match('/jak to działa|proces|krok po kroku|jak zamówić|procedura/', $message)) {
            return [
                'message' => 'Proces jest prosty jak 1-2-3! 📝 1) Wchodzisz do kreatora i projektujesz etykietę (kształt, rozmiar, design) 2) Wybierasz materiał i ilość 3) Składasz zamówienie i płacisz 4) My drukujemy i wysyłamy w 3-5 dni! Masz podgląd na żywo, więc widzisz dokładnie jak będzie wyglądać. Chcesz spróbować?',
                'actions' => [
                    ['text' => '🚀 Zacznij Projektować', 'url' => '/creator'],
                    ['text' => '👀 Zobacz Przykłady', 'action' => 'scroll-to-configs']
                ]
            ];
        }
        
        // Pytania o problemy/trudności
        if (preg_match('/problem|trudność|nie wiem jak|nie umiem|pomóż mi|zagubiony/', $message)) {
            return [
                'message' => 'Nie martw się, każdy kiedyś zaczynał! 🤗 Jestem tutaj żeby Ci pomóc krok po kroku. Powiedz mi - czy to Twoja pierwsza etykieta? Jaki masz problem konkretnie? Może nie wiesz od czego zacząć, czy masz trudności techniczne? Razem to rozwiążemy!',
                'actions' => [
                    ['text' => '🆘 Pomoc Krok po Kroku', 'action' => 'scroll-to-faq'],
                    ['text' => '🎯 Zacznij Prosto', 'action' => 'scroll-to-configs'],
                    ['text' => '💬 Opowiedz o Problemie', 'action' => 'scroll-to-faq']
                ]
            ];
        }
        
        // Pytania o zastosowanie/do czego
        if (preg_match('/do czego|zastosowanie|na co|gdzie użyć|przykłady/', $message)) {
            return [
                'message' => 'Etykiety mają milion zastosowań! 🏷️ Produkty spożywcze, kosmetyki, butelki wina, słoiki z miodem, opakowania handmade, oznaczenia firmowe, kody QR, adresy zwrotne, dekoracje na wesela, oznaczenia w biurze... Praktycznie wszędzie gdzie potrzebujesz czegoś oznaczyć! Na co myślisz?',
                'actions' => [
                    ['text' => '🍯 Produkty Spożywcze', 'action' => 'scroll-to-configs'],
                    ['text' => '💼 Firmowe', 'action' => 'scroll-to-configs'],
                    ['text' => '🎨 Kreatywne', 'url' => '/creator'],
                    ['text' => '📦 Logistyczne', 'action' => 'scroll-to-configs']
                ]
            ];
        }
        
        // Pytania o czas/termin
        if (preg_match('/kiedy|termin|czas|szybko|natychmiast|pilne/', $message)) {
            return [
                'message' => 'Rozumiem, że czas jest ważny! ⏰ Standardowo realizujemy zamówienia w 3-5 dni roboczych + czas dostawy (1-2 dni). Mamy też opcję ekspresową 24h za dopłatą. Potrzebujesz czegoś pilnie?',
                'actions' => [
                    ['text' => '⚡ Ekspres 24h', 'action' => 'scroll-to-pricing'],
                    ['text' => '🚀 Zacznij Teraz', 'url' => '/creator']
                ]
            ];
        }
        
        // Pytania o rozmiar/wielkość
        if (preg_match('/rozmiar|wielkość|duży|mały|szerokość|wysokość|cm|mm/', $message)) {
            return [
                'message' => 'Rozmiary? Mamy wszystko! 📏 Od małych 15x15mm (na słoiczki) po duże 200x300mm (na kartony). Popularne to: 50x30mm (produkty), 100x50mm (butelki), 70x70mm (słoiki). W kreatorze ustawisz dokładnie taki jaki potrzebujesz!',
                'actions' => [
                    ['text' => '📐 Ustaw Rozmiar', 'url' => '/creator'],
                    ['text' => '📋 Popularne Rozmiary', 'action' => 'scroll-to-configs']
                ]
            ];
        }
        
        // Pytania o kolory
        if (preg_match('/kolor|kolorowe|czarno-białe|rgb|cmyk|druk/', $message)) {
            return [
                'message' => 'Kolory to nasza specjalność! 🌈 Drukujemy w pełnym kolorze CMYK (4+0) w rozdzielczości 1200 DPI. Mamy też opcje specjalne: złoto, srebro, białą farbę na ciemnych materiałach. Kolory są żywe i trwałe!',
                'actions' => [
                    ['text' => '🎨 Zobacz Kolory', 'url' => '/creator'],
                    ['text' => '✨ Opcje Specjalne', 'action' => 'scroll-to-configs']
                ]
            ];
        }
        
        // Pytania o ilość/nakład
        if (preg_match('/ile|ilość|nakład|sztuk|egzemplarzy|minimum/', $message)) {
            return [
                'message' => 'Ilości? 📊 Minimum to 50 sztuk (mniejsze nakłady są nieopłacalne). Im więcej, tym taniej za sztukę! 100 szt = 3,50zł/szt, 500 szt = 2,80zł/szt, 1000 szt = 2,50zł/szt. Przy większych nakładach rabaty sięgają 40%!',
                'actions' => [
                    ['text' => '💰 Kalkulator Cen', 'action' => 'scroll-to-pricing'],
                    ['text' => '🚀 Sprawdź w Kreatorze', 'url' => '/creator']
                ]
            ];
        }
        
        return null;
    }

    private function extractKeywords($message)
    {
        // Lista kluczowych słów związanych z biznesem
        $businessKeywords = [
            'etykiety', 'etykieta', 'nalepki', 'nalepka', 'labels', 'stickers',
            'druk', 'drukowanie', 'printing', 'design', 'projekt', 'projektowanie',
            'materiał', 'materiały', 'papier', 'folia', 'laminat',
            'rozmiar', 'rozmiary', 'wielkość', 'wymiary', 'cm', 'mm',
            'cena', 'ceny', 'koszt', 'koszty', 'ile', 'płatność', 'zapłata',
            'zamówienie', 'zamówić', 'kupić', 'zakup', 'realizacja',
            'czas', 'termin', 'dostawa', 'wysyłka', 'szybko', 'pilne',
            'jakość', 'quality', 'trwałość', 'wodoodporne', 'premium',
            'firma', 'biznes', 'business', 'produkty', 'opakowania',
            'logo', 'branding', 'marka', 'reklama', 'marketing'
        ];
        
        $foundKeywords = [];
        $words = explode(' ', strtolower($message));
        
        foreach ($words as $word) {
            $word = trim($word, '.,!?;:');
            if (in_array($word, $businessKeywords)) {
                $foundKeywords[] = $word;
            }
        }
        
        return array_unique($foundKeywords);
    }

    private function getOpenAIResponse($message)
    {
        try {
            $apiKey = env('OPENAI_API_KEY');
            if (!$apiKey) return null;

            $systemPrompt = "Jesteś ekspertem od etykiet w firmie Custom Labels. Odpowiadaj po polsku, krótko i konkretnie. 
            
            INFORMACJE O FIRMIE:
            - Custom Labels - polska firma od 2020 roku
            - Specjalizujemy się w etykietach na produkty, opakowania, butelki
            - Materiały: papier kraft, biała folia, laminaty (matowe/błyszczące)
            - Rozmiary: od 15x15mm do 200x300mm
            - Minimum: 50 sztuk
            - Ceny: 100szt=3,50zł/szt, 500szt=2,80zł/szt, 1000szt=2,50zł/szt
            - Realizacja: 3-5 dni + dostawa, ekspres 24h możliwy
            - Jakość: druk CMYK 1200 DPI, wodoodporne
            - Kontakt: CustomLabelHelp@gmail.com
            - Kreator online: /creator
            
            ZASADY:
            - Bądź pomocny i konkretny
            - Używaj emoji (ale nie przesadzaj)
            - Kieruj do kreatora (/creator) gdy ktoś chce projektować
            - Podawaj konkretne ceny i terminy
            - Jeśli nie wiesz czegoś - przyznaj się
            - Maksymalnie 2-3 zdania odpowiedzi";

            $data = [
                'model' => 'gpt-3.5-turbo',
                'messages' => [
                    ['role' => 'system', 'content' => $systemPrompt],
                    ['role' => 'user', 'content' => $message]
                ],
                'max_tokens' => 150,
                'temperature' => 0.7
            ];

            $ch = curl_init('https://api.openai.com/v1/chat/completions');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Content-Type: application/json',
                'Authorization: Bearer ' . $apiKey
            ]);

            $response = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

            if ($httpCode === 200) {
                $result = json_decode($response, true);
                if (isset($result['choices'][0]['message']['content'])) {
                    $aiMessage = trim($result['choices'][0]['message']['content']);
                    
                    // Dodaj inteligentne akcje na podstawie odpowiedzi
                    $actions = $this->generateSmartActions($aiMessage, $message);
                    
                    return [
                        'message' => $aiMessage,
                        'actions' => $actions
                    ];
                }
            }
        } catch (\Exception $e) {
            // Jeśli API nie działa, spadaj na lokalną inteligencję
            return null;
        }

        return null;
    }

    private function generateSmartActions($aiMessage, $originalMessage)
    {
        $actions = [];
        
        // Inteligentne akcje na podstawie treści odpowiedzi AI
        if (str_contains(strtolower($aiMessage), 'kreator') || str_contains(strtolower($originalMessage), 'projekt')) {
            $actions[] = ['text' => '🚀 Otwórz Kreator', 'url' => '/creator'];
        }
        
        if (str_contains(strtolower($aiMessage), 'cen') || str_contains(strtolower($originalMessage), 'koszt')) {
            $actions[] = ['text' => '💰 Zobacz Ceny', 'action' => 'scroll-to-pricing'];
        }
        
        if (str_contains(strtolower($aiMessage), 'materiał') || str_contains(strtolower($originalMessage), 'materiał')) {
            $actions[] = ['text' => '📋 Materiały', 'action' => 'scroll-to-configs'];
        }
        
        if (str_contains(strtolower($aiMessage), 'pomoc') || str_contains(strtolower($originalMessage), 'problem')) {
            $actions[] = ['text' => '❓ FAQ', 'action' => 'scroll-to-faq'];
        }
        
        // Zawsze dodaj podstawowe akcje jeśli nie ma żadnych
        if (empty($actions)) {
            $actions = [
                ['text' => '🚀 Kreator', 'url' => '/creator'],
                ['text' => '💰 Cennik', 'action' => 'scroll-to-pricing']
            ];
        }
        
        return $actions;
    }

    private function getHuggingFaceResponse($message)
    {
        try {
            $apiKey = env('HUGGINGFACE_API_KEY');
            if (!$apiKey) return null;

            // Użyj darmowego modelu konwersacyjnego
            $model = 'microsoft/DialoGPT-medium';
            $url = "https://api-inference.huggingface.co/models/{$model}";

            $data = [
                'inputs' => "Jesteś ekspertem od etykiet w firmie Custom Labels. Odpowiadaj krótko po polsku. Pytanie: {$message}",
                'parameters' => [
                    'max_length' => 100,
                    'temperature' => 0.7,
                    'do_sample' => true
                ]
            ];

            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Content-Type: application/json',
                'Authorization: Bearer ' . $apiKey
            ]);

            $response = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

            if ($httpCode === 200) {
                $result = json_decode($response, true);
                if (isset($result[0]['generated_text'])) {
                    $aiMessage = trim($result[0]['generated_text']);
                    
                    // Oczyść odpowiedź z promptu
                    $aiMessage = str_replace("Jesteś ekspertem od etykiet w firmie Custom Labels. Odpowiadaj krótko po polsku. Pytanie: {$message}", '', $aiMessage);
                    $aiMessage = trim($aiMessage);
                    
                    if (!empty($aiMessage)) {
                        $actions = $this->generateSmartActions($aiMessage, $message);
                        
                        return [
                            'message' => $aiMessage . ' 🤖',
                            'actions' => $actions
                        ];
                    }
                }
            }
        } catch (\Exception $e) {
            return null;
        }

        return null;
    }

    private function getGroqResponse($message)
    {
        try {
            // Groq - DARMOWE i SZYBKIE API
            $apiKey = env('GROQ_API_KEY');
            if (!$apiKey) {
                \Log::info('GROQ API Key not found');
                return null;
            }
            
            \Log::info('GROQ API Key found, making request for: ' . $message);

            $systemPrompt = "Jesteś ekspertem od etykiet w firmie Custom Labels. Odpowiadaj po polsku, krótko i konkretnie. Custom Labels to polska firma od 2020 roku specjalizująca się w etykietach. Materiały: papier kraft, biała folia, laminaty. Rozmiary: 15x15mm do 200x300mm. Minimum 50 sztuk. Ceny: 100szt=3,50zł/szt. Realizacja 3-5 dni. Kreator: /creator";

            $data = [
                'model' => 'llama-3.1-8b-instant', // Najnowszy darmowy model
                'messages' => [
                    ['role' => 'system', 'content' => $systemPrompt],
                    ['role' => 'user', 'content' => $message]
                ],
                'max_tokens' => 150,
                'temperature' => 0.7
            ];

            $ch = curl_init('https://api.groq.com/openai/v1/chat/completions');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Content-Type: application/json',
                'Authorization: Bearer ' . $apiKey
            ]);

            $response = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

            if ($httpCode === 200) {
                $result = json_decode($response, true);
                \Log::info('GROQ Response: ' . json_encode($result));
                if (isset($result['choices'][0]['message']['content'])) {
                    $aiMessage = trim($result['choices'][0]['message']['content']);
                    $actions = $this->generateSmartActions($aiMessage, $message);
                    
                    \Log::info('GROQ Success: ' . $aiMessage);
                    return [
                        'message' => $aiMessage . ' ⚡',
                        'actions' => $actions
                    ];
                }
            } else {
                \Log::error('GROQ HTTP Error: ' . $httpCode . ' Response: ' . $response);
            }
        } catch (\Exception $e) {
            \Log::error('GROQ Exception: ' . $e->getMessage());
            return null;
        }

        return null;
    }

    public function executeAction($action)
    {
        switch ($action) {
            case 'scroll-to-configs':
                $this->dispatch('scroll-to-element', '#gotowe-konfiguracje');
                break;
            case 'scroll-to-pricing':
                $this->dispatch('scroll-to-element', '#pricing');
                break;
            case 'scroll-to-newsletter':
                $this->dispatch('scroll-to-element', '#newsletter');
                break;
            case 'scroll-to-faq':
                $this->dispatch('scroll-to-element', '#faq');
                break;
            case 'scroll-to-materials':
                $this->dispatch('scroll-to-element', '#gotowe-konfiguracje');
                break;
            case 'open-profile':
                return redirect()->route('settings.profile');
                break;
            case 'show-discount':
                $this->messages[] = [
                    'type' => 'bot',
                    'message' => '🎁 Kod rabatowy dla nowych użytkowników: <strong>WELCOME20</strong> - 20% zniżki na pierwszą etykietę!',
                    'time' => now()->format('H:i')
                ];
                break;
        }
    }

    public function render()
    {
        return view('livewire.ai-assistant');
    }
}
