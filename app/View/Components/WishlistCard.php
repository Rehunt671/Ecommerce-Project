namespace App\View\Components;

use App\Models\Product;
use Illuminate\View\Component;

class WishlistCard extends Component
{
    public $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function render()
    {
        return view('components.wishlist-card');
    }
}
