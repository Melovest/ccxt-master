using ccxt;
namespace Tests;

// PLEASE DO NOT EDIT THIS FILE, IT IS GENERATED AND WILL BE OVERWRITTEN:
// https://github.com/ccxt/ccxt/blob/master/CONTRIBUTING.md#how-to-contribute-code


public partial class testMainClass : BaseTest
{
    async static public Task testFetchBorrowInterest(Exchange exchange, object skippedProperties, object code, object symbol)
    {
        object method = "fetchBorrowInterest";
        object borrowInterest = await exchange.fetchBorrowInterest(code, symbol);
        testSharedMethods.assertNonEmtpyArray(exchange, skippedProperties, method, borrowInterest, code);
        for (object i = 0; isLessThan(i, getArrayLength(borrowInterest)); postFixIncrement(ref i))
        {
            testBorrowInterest(exchange, skippedProperties, method, getValue(borrowInterest, i), code, symbol);
        }
    }

}