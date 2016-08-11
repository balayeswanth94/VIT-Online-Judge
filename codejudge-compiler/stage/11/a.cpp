#include<iostream>
#include<vector>
using namespace std;
int rev(int n)
{
	int m=0;
	while(n>0)
	{
		m = m*10 + n%10;
		n/=10;
	}
	return m;
}

int main()
{
	int t;
	cin>>t;
	while(t--)
	{
		int m,n;
		cin>>m>>n;
		int s = rev(m);
		int r = rev(n);
		int sum = s + r;
		cout<<rev(sum)<<endl;
	}
}
