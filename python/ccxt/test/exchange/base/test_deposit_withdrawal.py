import os
import sys

root = os.path.dirname(os.path.dirname(os.path.dirname(os.path.dirname(os.path.dirname(os.path.abspath(__file__))))))
sys.path.append(root)

# ----------------------------------------------------------------------------

# PLEASE DO NOT EDIT THIS FILE, IT IS GENERATED AND WILL BE OVERWRITTEN:
# https://github.com/ccxt/ccxt/blob/master/CONTRIBUTING.md#how-to-contribute-code

# ----------------------------------------------------------------------------
# -*- coding: utf-8 -*-

from ccxt.test.exchange.base import test_shared_methods  # noqa E402

def test_deposit_withdrawal(exchange, skipped_properties, method, entry, requested_code, now):
    format = {
        'info': {},
        'id': '1234',
        'txid': '0x1345FEG45EAEF7',
        'timestamp': 1502962946216,
        'datetime': '2017-08-17 12:42:48.000',
        'network': 'ETH',
        'address': '0xEFE3487358AEF352345345',
        'addressTo': '0xEFE3487358AEF352345123',
        'addressFrom': '0xEFE3487358AEF352345456',
        'tag': 'smth',
        'tagTo': 'smth',
        'tagFrom': 'smth',
        'type': 'deposit',
        'amount': exchange.parse_number('1.234'),
        'currency': 'USDT',
        'status': 'ok',
        'updated': 1502962946233,
        'fee': {},
    }
    empty_allowed_for = ['address', 'addressTo', 'addressFrom', 'tag', 'tagTo', 'tagFrom']  # below we still do assertion for to/from
    test_shared_methods.assert_structure(exchange, skipped_properties, method, entry, format, empty_allowed_for)
    test_shared_methods.assert_timestamp_and_datetime(exchange, skipped_properties, method, entry, now)
    test_shared_methods.assert_currency_code(exchange, skipped_properties, method, entry, entry['currency'], requested_code)
    #
    test_shared_methods.assert_in_array(exchange, skipped_properties, method, entry, 'status', ['ok', 'pending', 'failed', 'rejected', 'canceled'])
    test_shared_methods.assert_in_array(exchange, skipped_properties, method, entry, 'type', ['deposit', 'withdrawal'])
    test_shared_methods.assert_greater_or_equal(exchange, skipped_properties, method, entry, 'amount', '0')
    test_shared_methods.assert_fee_structure(exchange, skipped_properties, method, entry, 'fee')
    if entry['type'] == 'deposit':
        test_shared_methods.assert_type(exchange, skipped_properties, entry, 'addressFrom', format)
    else:
        test_shared_methods.assert_type(exchange, skipped_properties, entry, 'addressTo', format)