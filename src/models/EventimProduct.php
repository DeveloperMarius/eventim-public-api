<?php

namespace developermarius\eventim\publicapi\models;

use utils\DataClass;

/**
 *
 * @method string getId()
 * @method string getGroupId()
 * @method string getName()
 * @method null|string getDescription()
 * @method EventimProductType getType()
 * @method EventimProductStatus getStatus()
 * @method string getLink()
 * @method EventimUrl getUrl()
 * @method null|string getImageUrl()
 * @method null|float getPrice()
 * @method null|string getCurrency()
 * @method bool isInStock()
 * @method EventimTypeAttributes getTypeAttributes()
 * @method array getAttractions()
 * @method EventimCategory[] getCategories()
 * @method array getRating()
 * @method array getTags()
 * @method bool hasRecommendation()
 *
 */
class EventimProduct extends DataClass{

    protected string $id;
    protected string $group_id;
    protected string $name;
    protected string $description;
    protected EventimProductType $type;
    protected EventimProductStatus $status;
    protected string $link;
    protected EventimUrl $url;
    protected bool $in_stock;
    protected ?string $image_url;
    protected ?float $price;
    protected ?string $currency;
    protected EventimTypeAttributes $type_attributes;
    protected array $attractions;
    protected array $categories;
    protected EventimProductRating $rating;
    protected array $tags;
    protected bool $recommendation;

    public function __construct(array $data){
        //Sometimes the name starts with a whitespace
        $data['name'] = trim($data['name']);
        $this->setProperties($data, array(
            'type' => EventimProductType::class,
            'status' => EventimProductStatus::class,
            'url' => EventimUrl::class,
            'type_attributes' => EventimTypeAttributes::class,
            'attractions' => EventimAttraction::class,
            'categories' => EventimCategory::class,
            'rating' => EventimProductRating::class,
        ), array(
            'productId' => 'id',
            'productGroupId' => 'group_id',
            'imageUrl' => 'image_url',
            'inStock' => 'in_stock',
            'typeAttributes' => 'type_attributes',
            'hasRecommendation' => 'recommendation',
        ));
    }

    /**
     * The Response also contains Ticket upgrades, parking tickets, etc. This method checks if the product is a real event
     */
    public function isEvent(): bool{
        /*
         * Premium Parkplatz - LANXESS arena
         * Parkplatz - RheinEnergieSTADION
         * Parkplatz - Herr Schröder
         * Gastro-Garderobe-Voucher - QUARTERBACK Immobilien ARENA Leipzig
         * Parkplatz-Garderobe-Voucher - QUARTERBACK Immobilien ARENA Leipzig
         *
         * Business Seat Package - Helene Fischer - 360° Stadion Tour 2026
         * Business Seat Paket (West) - Peter Maffay
         *
         * Upgrade - Restaurant Henkelmännchen - Justin Timberlake
         * Upgrade - Restaurant Henkelmännchen - Die Fantastischen Vier
         * Fan Upgrade | Peter Maffay & Band - We Love Rock 'n' Roll
         *
         * Loge / Premiumbereich - Justin Timberlake - The Forget Tomorrow World Tour
         * Loge / Premiumbereich - Die Fantastischen Vier - Long Player On Tour 2024
         *
         * Hot Tickets - Nick Cave & The Bad Seeds - The Wild God Tour
         * Premium Tickets - Justin Timberlake - The Forget Tomorrow World Tour
         * Premium Ticket - Holiday on Ice - NEW SHOW
         * Manifest / Premium Ticket - KONTRA K - Augen träumen Herzen sehen Tour 2025
         * Manifest / Premium Ticket - Nick Cave & The Bad Seeds - The Wild God Tour
         * Manifest Ticket - Till Reiners - mein Italien GRANDISSIMO
         * HOUSE OF BANKSY - Flex-/Geschenkticket Juli
         *
         * Early Entry Package - KONTRA K - Augen träumen Herzen sehen Tour 2025
         *
         * VIP 3 - I Remember It All Too Well Package | Taylor Swift
         * VIP 5 - It’s A Love Story Package | Taylor Swift
         * VIP Packages - Helene Fischer - 360° Stadiontour 2026
         * VIP Ticket - Night of the Proms 2024
         * VIP Upgrade - Sean Paul - Live with Band
         * VIP Premium Lounge - SIXX PAXX
         * VIP Hot Seat - Luciano - Tour 2025
         * VIP Early Entry - Luciano - Tour 2025
         * VIP Aftershow Package - Ikke Hüftgold - Nummer Eins - Live Tour 2024
         * VIP Package BACKSTAGE CLUB - CRO
         * Diamond VIP Package - Nick Cave & The Bad Seeds - The Wild God Tour
         * Emerald VIP Package - Nick Cave & The Bad Seeds - The Wild God Tour
         * Harry Potter™ - Die Ausstellung | VIP-Ticket
         * INSANO VIP Package
         */
        preg_match('/[a-zA-Z0-9]+ VIP/', $this->getName(), $matches1);
        preg_match('/[a-zA-Z0-9]+ Tickets/', $this->getName(), $matches2);
        return !(
            str_starts_with($this->getName(), 'Upgrade') ||
            str_starts_with($this->getName(), 'VIP') ||
            str_starts_with($this->getName(), 'Business Seat') ||
            str_contains($this->getName(), 'Parkplatz') ||
            str_contains($this->getName(), 'Garderobe') ||
            str_contains($this->getName(), 'Geschenkticket') ||
            str_starts_with($this->getName(), 'Loge') ||
            str_starts_with($this->getName(), 'Premium Ticket') ||
            str_starts_with($this->getName(), 'Manifest / Premium Ticket') ||
            str_starts_with($this->getName(), 'Manifest Ticket') ||
            str_starts_with($this->getName(), 'Early Entry Package') ||
            str_starts_with($this->getName(), 'Fan Upgrade') ||
            str_ends_with($this->getName(), 'VIP-Ticket') ||
            str_ends_with($this->getName(), 'VIP Package') ||
            sizeof($matches1) > 0 ||
            sizeof($matches2) > 0
        );
    }
}