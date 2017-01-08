<?PHP

namespace Bcismariu\Lead5Media\Tests\Stubs;

/**
 * A stub for Http requests;
 */
class ResponseStub
{
    protected $contents;

    public function __construct($contents = '')
    {
        $this->contents = $contents;
    }

    public function getBody()
    {
        return $this;
    }

    public function getContents()
    {
        return $this->contents;
    }
}
