<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Authenticatable;

/**
 * Get Data User Login
 *
 * @return Authenticatable
 */
function userLogin(): Authenticatable
{
  return Auth::user();
}

function userRole()
{
  return auth()->user()->roles->implode('name');
}

function getFullNameLong()
{
  if (getFirstTitle() && getLastTitle()) :
    return getFirstTitle() . getFullNameShort() . getLastTitle();
  endif;

  if (getFirstTitle()) :
    return getFirstTitle() . getFullNameShort();
  endif;

  if (getLastTitle()) :
    return getFullNameShort() . getLastTitle();
  endif;

  return getFullNameShort();
}

function getFullNameShort()
{
  return getFirstName() . ' ' . getLastName();
}

function getFirstName()
{
  return userLogin()->first_name;
}

function getLastName()
{
  return userLogin()->last_name;
}

function getFirstTitle()
{
  return userLogin()->first_title ? userLogin()->first_title : '';
}

function getLastTitle()
{
  return userLogin()->last_title ? ', ' . userLogin()->last_title : '';
}
