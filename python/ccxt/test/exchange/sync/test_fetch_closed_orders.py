import os
import sys

root = os.path.dirname(os.path.dirname(os.path.dirname(os.path.dirname(os.path.dirname(os.path.abspath(__file__))))))
sys.path.append(root)

# ----------------------------------------------------------------------------

# PLEASE DO NOT EDIT THIS FILE, IT IS GENERATED AND WILL BE OVERWRITTEN:
# https://github.com/ccxt/ccxt/blob/master/CONTRIBUTING.md#how-to-contribute-code

# ----------------------------------------------------------------------------
# -*- coding: utf-8 -*-

from ccxt.test.exchange.base import test_order  # noqa E402
from ccxt.test.exchange.base import test_shared_methods  # noqa E402

def test_fetch_closed_orders(exchange, skipped_properties, symbol):
    method = 'fetchClosedOrders'
    orders = exchange.fetch_closed_orders(symbol)
    test_shared_methods.assert_non_emtpy_array(exchange, skipped_properties, method, orders, symbol)
    now = exchange.milliseconds()
    for i in range(0, len(orders)):
        order = orders[i]
        test_order(exchange, skipped_properties, method, order, symbol, now)
        test_shared_methods.assert_in_array(exchange, skipped_properties, method, order, 'status', ['closed', 'canceled'])
    test_shared_methods.assert_timestamp_order(exchange, method, symbol, orders)