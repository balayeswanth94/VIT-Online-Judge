#include<iostream>
#include<stdio.h>
#include<map>
using namespace std;
map<unsigned long long int,unsigned long long int>sum;

unsigned long long int compute(int n)
{
	if(n == 0)
	return 0;
	else if(sum.find(n) != sum.end())
	return sum.find(n)->second;
	else
	{
		unsigned long long int a = n/2, b = n/3, c = n/4,s,t;
		s = compute(a) + compute(b) + compute(c);
		t = (n>s)?n:s;
		sum[n] = t;
		return t;
	}	
}


int main()
{
	unsigned long long int n;
	while(cin>>n)
	cout<<compute(n)<<endl;
	return 0;
}