#include<iostream>
#include<stdio.h>

using namespace std;
long long int arr[1000000]={0};
long long int coin(long long int n)
{
	if(n==0)
		return 0;
	else if(n<12)
		return n;
	if(n<1000000)
	{
		if(arr[n]>0)
			return arr[n];
	}
		long long int res = max(n,coin(n/2)+coin(n/3)+coin(n/4));
		if(n<1000000) 
			arr[n]=res;
		return res;
}
int main()
{
	long long int n,res;
	while(scanf("%lld",&n)!=EOF) 
	{
		res = coin(n);
		printf("%lld\n",res);
	}
	return 0;
}