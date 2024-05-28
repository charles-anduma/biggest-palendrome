<?php


use App\BiggestPalendrome;
use PHPUnit\Framework\TestCase;

class PalindromeTest extends TestCase
{
    public function test_calc(): void
    {
        $palindrome = new BiggestPalendrome();

        $this->assertEquals('3', $palindrome->calc('123'));
        $this->assertEquals('323', $palindrome->calc('233'));
        $this->assertEquals('4326234', $palindrome->calc('234324326'));
    }

    public function test_createTreeItems(): void
    {
        $palindrome = new BiggestPalendrome();

        $numbersString = '123';
        $numbers = str_split($numbersString);

        $carriedNumber = '';
        $finalCombinations = [];
        $palindrome->createTreeItems($numbers, $carriedNumber, $finalCombinations);
        $this->assertEquals(
            ['1', '12', '123', '13', '132', '2', '21', '213', '23', '231', '3', '31', '312', '32', '321'],
            $finalCombinations
        );
    }

    public function test_getPalindromes(): void
    {
        $palindrome = new BiggestPalendrome();
        $foo = self::getMethod('getPalindromes');

        $this->assertEquals(['313'], $foo->invokeArgs($palindrome, [['313', '223']]));
        $this->assertEquals([], $foo->invokeArgs($palindrome, [['3131', '2231']]));
        $this->assertEquals(['313', '53135'], array_values($foo->invokeArgs($palindrome, [['313', '223', '53135']])));
    }

    public function test_getBiggestNumber(): void
    {
        $palindrome = new BiggestPalendrome();
        $foo = self::getMethod('getBiggestNumber');

        $this->assertEquals(3, $foo->invokeArgs($palindrome, [[1, 2, 3]]));
        $this->assertEquals(false, $foo->invokeArgs($palindrome, [[]]));
    }

    protected static function getMethod($name)
    {
        $class = new ReflectionClass('App\BiggestPalendrome');
        $method = $class->getMethod($name);
        // $method->setAccessible(true); // Use this if you are running PHP older than 8.1.0
        return $method;
    }
}
